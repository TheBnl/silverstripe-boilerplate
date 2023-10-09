{
  const anchors = document.getElementsByClassName('anchor');
  for (let anchor of anchors) {
    anchor.addEventListener('click', (event) => {
      const element = document.getElementById(anchor.hash.substring(1));
      if (element) {
        event.preventDefault();
        scrollTo(element);
      }
    });
  }
  
  if (window.location.hash) {
    const element = document.getElementById(window.location.hash.substring(1));
    if (element) {
      scrollTo(element);
    }
  }
};

export const scrollTo = function(element) {
  element.scrollIntoView({
    behavior: 'smooth',
    block: 'center'
  });
};