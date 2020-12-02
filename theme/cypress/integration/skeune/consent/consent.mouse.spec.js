/**
 * Tests for behaviour of the consent screen which depends on the mouse.
 */
context('Consent when using the mouse', () => {
  beforeEach(() => {
    cy.visit('https://engine.vm.openconext.org/functional-testing/consent');
  });

  describe('Test showing / hiding the extra attributes', () => {
    it('Should show the extra attributes after clicking the label', () => {
      cy.contains('label', 'Show more information')
        .click();
      cy.contains('label', 'Show less information');
      cy.get('ul.consent__attributes--nested')
        .should('be.visible');
    });

    it('Should hide the extra attributes after clicking the label again', () => {
      // first click the show more label to show the attributes
      cy.contains('label', 'Show more information')
        .click({force: true});

      // try to hide them again
      cy.contains('label', 'Show less information')
        .click({force: true});

      // test assertions
      cy.contains('label', 'Show more information');
      cy.get('ul.consent__attributes--nested')
        .should('not.be.visible');
    });
  });

  describe('Shows / hides the tooltips on click', () => {
    it('Shows the tooltip', () => {
      cy.get('label.tooltip[for="tooltip3"]:not(:first-child)')
        .click({force: true})
        .next()
        .should('be.visible');
    });

    it('Hides the tooltip', () => {
      // Make it visible
      cy.get('label.tooltip[for="tooltip3"]:not(:first-child)')
        .click({force: true})
        .next();

      // Hide and check if it worked
      cy.get('label.tooltip[for="tooltip3"]:not(:first-child)')
        .click({force: true})
        .next()
        .should('not.be.visible');
    });
  });

  describe('Shows the modals on click', () => {
    it('Should show the nok-modal', () => {
      cy.contains('label', 'Something incorrect?')
        .click({force: true});
      cy.contains('Is the data shown incorrect?')
        .should('be.visible');
    });

    it('Should show the decline consent modal', () => {
      cy.contains('label', 'Cancel')
        .click({force: true});
      cy.contains('You don\'t want to share your data with the service')
        .should('be.visible');
    });
  });
});
