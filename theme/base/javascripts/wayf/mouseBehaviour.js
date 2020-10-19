import {submitForm} from './submitForm';

export const mouseBehaviour = (previouslySelectedIdps) => {
// allow chosing an idp to login
  const idpLists = document
    .querySelectorAll('.wayf__idpList');
  idpLists.forEach(list => list.addEventListener('click', (e) => {
    submitForm(e, previouslySelectedIdps);
  }));
};