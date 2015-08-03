var OpenConext = {};
OpenConext.Discover = function () {
  'use strict';
  var lastMouseX = null,
    lastMouseY = null;
  this.searchBar = $('.mod-search-input');

  function hasDiscovery() {
    return 0 !== $('.mod-search-input').length;
  }

  function checkListVisible(listContainer) {
    var list = listContainer.find('.list:first');

    if (list.children().length === 0 || list.find('.active').length === 0) {
      listContainer.addClass('hidden');
    } else {
      listContainer.removeClass('hidden');
    }

  }

  function checkVisible() {
    checkListVisible($('#preselection'));
    checkListVisible($('#noselection'));
  }

  function checkNoResults() {
    var selectionContainer = $('#selection'),
      noResultsContainer = selectionContainer.find('.noresults');

    if (selectionContainer.find('.list a.active').length === 0) {
      noResultsContainer.removeClass('hidden');
    } else {
      noResultsContainer.addClass('hidden');
    }
  }

  function filterList(filterValue) {
    var filterElements = $('.mod-results a.result'),
        spinner = $('.mod-results .spinner');

    spinner.removeClass('hidden');

    filterValue = filterValue.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').toLowerCase();

    filterElements.each(function () {
      var result = $(this),
          title = result.find('h3').text().toLowerCase(),
          match = title.indexOf(filterValue) !== -1;

      if (!match) {
        match = match || arraySome(result.data('keywords'), predicateContainsString(filterValue));
      }

      result
          .toggleClass('active', match)
          .toggleClass('hidden', !match);
    });

    checkVisible();
    checkNoResults();
    setFocusClass();
    spinner.addClass('hidden');

    // trigger the resize event to lazyload images
    $(window).trigger('resize');
  }

  function mouseNavigation(e) {
    removeFocusClass();

    if (
      (lastMouseX === null && lastMouseY === null) ||
      (lastMouseX === e.clientX && lastMouseY === e.clientY)
    ) {
      lastMouseX = e.clientX;
      lastMouseY = e.clientY;
      return;
    }

    lastMouseX = e.clientX;
    lastMouseY = e.clientY;

    $('.mod-results').addClass('mouse-nav');
  }

  function keyNavigation(e) {
    var currentElement = $(document.activeElement),
      list = $('.list'),
      key = e.which;

    $('.mod-results').removeClass('mouse-nav');

    function pressEnter() {
      e.preventDefault();
      // Press enter on searchbox
      if (currentElement.hasClass('mod-search-input')) {
        list.find('.active:first').first().focus().trigger('click');
      }

      // Press enter on result
      if (currentElement.attr('href') === '#') {
        currentElement.trigger('click');
      }
    }

    function pressDownArrow() {
      // moving from the searchbox
      if (currentElement.closest('.active').next().attr('type') === 'hidden') {
        var nextElement = list.find('.active:first');

        if (nextElement.length > 0) {
          nextElement[0].focus();
          removeFocusClass();
        }
        return;
      }

      // moving in a list
      if (currentElement.nextAll('.active:first').length > 0) {
        currentElement.nextAll('.active:first').focus();
        removeFocusClass();
        return;
      }

      // moving to next list
      if (currentElement.parent().parent().next().find('.active:first').length > 0) {
        currentElement.parent().parent().next().find('.active:first').focus();
        removeFocusClass();
      }
    }

    function pressUpArrow() {
      // move up in list
      if (currentElement.prevAll('.active:first').length > 0) {
        currentElement.prevAll('.active:first').focus();
        removeFocusClass();
        return;
      }

      // move up in previous list
      if (currentElement.parent().parent().prev().find('.active:last').length > 0) {
        currentElement.parent().parent().prev().find('.active:last').focus();
        removeFocusClass();
        return;
      }

      // move up to search
      if (currentElement.prevAll('.active:first').length === 0) {
        $('input.mod-search-input').focus();
      }
    }

    switch (key) {
      case 13:
        pressEnter();
        break;
      case 40:
        pressDownArrow();
        break;
      case 38:
        pressUpArrow();
        break;
    }

  }

  function removeFocusClass() {
    $('.result.focussed').removeClass('focussed');
  }

  function setFocusClass() {
    var firstActive = $('.result.active:first');

    removeFocusClass();

    firstActive.addClass('focussed');
  }

  if (!hasDiscovery()) {
    return this;
  }

  var cookieIdps = Cookies.get('selectedidps') || '[]',
    selectedIdps = JSON.parse(cookieIdps) || [],
    listedIdp;

  for (var j = 0; j < selectedIdps.length; j++) {
    listedIdp = $('#selection a[data-idp]').filter(function () {
      return $(this).data('idp') === selectedIdps[j];
    });
    $('#preselection .list').append(listedIdp);
  }

  function initModal(modal) {
    $('.close-modal').on('click', function closeModal(e) {
      e.preventDefault();
      $('#request-access').trigger('closeModal');
    });
    $('#name').focus();

    $('#request_access_submit').on('click', function (e) {
      e.preventDefault();
      var formData = $('#request_access_form').serialize();
      $.post('/authentication/idp/performRequestAccess', formData)
        .done(function (data) {
          $("#request-access").html(data);
          initModal(modal);
        });
    });
  }

  var arraySome = Array.prototype.some
    ? function arraySome(array, predicate) {
      return array.some(predicate);
    }
    : function arraySome(array, predicate) {
      for (var i = array.length - 1; i >= 0; i--) {
        if (predicate(array[i])) {
          return true;
        }
      }

      return false;
    };

  function predicateContainsString(equalTo) {
    return function (value) {
      return value === value.toString() && value.indexOf(equalTo) !== -1;
    }
  }

  var isArray = Array.isArray || function isArray(array) {
    return Object.prototype.toString(array) === '[object Array]'
  };

  checkVisible();
  checkNoResults();
  setFocusClass();
  $('#request-access').easyModal({
    onOpen: initModal,
    onClose: function() {
      $('#request-access').html('');
      $('input.mod-search-input').focus();
    }
  });

  // Listening to multiple events: 'input' for changes in input text, except for IE, which does not register character
  // deletions; 'keyup' for character deletions in IE; 'mouseup' for clicks on IE's native input clear button. The
  // 0-millisecond timeout is there to retrieve the input value after 'mouseup' events.
  this.searchBar.on('input keyup mouseup', function inputDetected(event) {
    setTimeout(function () {
      filterList($(event.target).val());
    }, 0);
  });

  var searchValue = $('input.mod-search-input').val();

  if (searchValue) {
    filterList(searchValue);
  }

  $('.mod-results a.edit').on('click', function editPreselection(e) {
    var editLink = $(this),
      mode = editLink.attr('data-toggle'),
      removeables = $('#preselection .c-button'),
      list = $('#preselection .list'),
      item, x, swapText;

    e.preventDefault();

    if (mode === 'view') {
      list.addClass('show-buttons');

      swapText = editLink.attr('data-toggle-text');
      editLink.attr('data-toggle-text', editLink.html());
      editLink.html(swapText);

      for (x = 0; x < removeables.length; x++) {
        item = $(removeables[x])
          .removeClass('white')
          .addClass('outline deleteable img');

        swapText = item.attr('data-toggle-text');
        item.attr('data-toggle-text', item.html());
        item.html(swapText);
      }
      editLink.attr('data-toggle', 'edit');
    } else {
      list.removeClass('show-buttons');

      swapText = editLink.attr('data-toggle-text');
      editLink.attr('data-toggle-text', editLink.html());
      editLink.html(swapText);

      for (x = 0; x < removeables.length; x++) {
        item = $(removeables[x])
          .removeClass('outline deleteable img')
          .addClass('white');

        swapText = item.attr('data-toggle-text');
        item.attr('data-toggle-text', item.html());
        item.html(swapText);
      }

      editLink.attr('data-toggle', 'view');
    }
  });

  $('a.noaccess').on('click', function requestAccess(e) {
    e.preventDefault();
    var noAccessLink = $(this),
      idpEntityId = noAccessLink.attr('data-idp') || 'unknown',
      idpName = noAccessLink.text(),
      params = {
        lang: discover.lang,
        idpEntityId: idpEntityId,
        idpName: idpName,
        spEntityId: discover.spEntityId,
        spName: discover.spName
      };

    $.get('/authentication/idp/requestAccess?' + $.param(params), function (data) {
      $('#request-access').html(data).trigger('openModal');
    });
  });

  $('.mod-results a.result.access').on('click', function handleIdpAction(e) {
    var accessLink = $(this),
      selectedIdp = accessLink.attr('data-idp');

    if ($(e.target).hasClass('deleteable')) {
      var saveIndex = $.inArray(selectedIdp, selectedIdps);

      e.stopPropagation();
      e.preventDefault();

      if (saveIndex > -1) {
        selectedIdps.splice(saveIndex, 1);
        accessLink.slideUp('fast', function() {
          accessLink.remove();
          checkVisible();
        });
      }
    } else {
      $('#form-idp').val(selectedIdp);

      if ($.inArray(selectedIdp, selectedIdps) === -1) {
        selectedIdps.push(selectedIdp);
      }
      $('form.mod-search').submit();
    }

    Cookies.set('selectedidps', JSON.stringify(selectedIdps), { expires: 365, path: '/' });
  });

  $('body').on('keydown', keyNavigation);
  $('.mod-results').on('mousemove', mouseNavigation);
  $('img.logo').lazyload();
  this.searchBar.on('focus', function() {
    var val = this.value;
    var $this = $(this);
    $this.val("");
    setTimeout(function () {
      $this.val(val);
    }, 1);
    setFocusClass();
  });

  // on desktop devices set the focus
  if (window.innerWidth > 800) {
    this.searchBar.focus();
  }
};

OpenConext.Tabs = function () {
  'use strict';
  this.activeTab = '';

  function hasTabs() {
    return 0 !== $('.mod-tabs').length;
  }

  function getActiveTab() {
    var firstTab = $('.mod-tabs .tab-target')[0],
      currentHash = window.location.hash,
      activeTab;

    if (currentHash !== '') {
      activeTab = currentHash;
    } else if (null !== firstTab) {
      activeTab = $(firstTab).attr('href');
    } else {
      activeTab = '';
    }

    return activeTab;
  }

  function setTab(activeTabId) {
    var tabPanels = $('.mod-tabpanel'),
      panel, panelId, i;

    for (i = 0; i < tabPanels.length; i++) {
      panel = $(tabPanels[i]);
      panelId = panel.attr('id');

      if (panelId === activeTabId) {
        panel.addClass('active');
      } else {
        panel.removeClass('active');
      }
    }
    $('.tab-target').removeClass('active');
    $('.tab-target[href="#' + activeTabId + '"]').addClass('active');
    $('.comp-language a').each(function(){
      var val = $(this).attr('href'),
        newVal = val.split('#')[0];
      $(this).attr('href', newVal + '#' + activeTabId);
    });
  }

  if (!hasTabs()) {
    return this;
  }

  this.activeTab = getActiveTab();

  if (this.activeTab !== '') {
    setTab(this.activeTab.replace('#', ''));
    window.addEventListener('hashchange', function tabActivated() {
      setTab(getActiveTab().replace('#', ''));
    }, false);
  }
};

OpenConext.Profile = function () {
  $(document.body).on('click', '#MyAppsTable .sp-row .sp-display-name', function (event) {
    event.preventDefault();

    $(this).parents('.sp-row')
        .next('.attribute-table-row')
        .toggleClass('attribute-table-row-expanded');
  });
};

$('html').removeClass('no-js');
$(function init() {

  new OpenConext.Tabs();
  new OpenConext.Discover();
  new OpenConext.Profile();
  FastClick.attach(document.body);

  if ($('#engine-main-page').length > 0) {
      // set absolute URLs of anchors as display text
      $('dl.metadata-certificates-list a').not('a[data-external-link=true]').each(function(){
        $(this).text(
          window.location.protocol + '//' + window.location.hostname + $(this).attr('href')
        );
      });
  }

  $('#delete-confirmation-form').submit(function() {
    return confirm($('#delete-confirmation-text').attr('data-confirmation-text'));
  });
});

