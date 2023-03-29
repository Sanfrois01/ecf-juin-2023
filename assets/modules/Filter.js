import { Flipper , spring } from "flip-toolkit"

/**
 * @property {HTMLElement} content
 * @property {HTMLFormElement} form
 */



export default class Filter {
  /**
   * @param {HTMLElement|null} element
   */
    constructor(element) {
      if (element == null) {
        return
      }
      this.content = element.querySelector('.js-filter-content')
      this.form = element.querySelector('.js-filter-form')
      this.bindEvents()
    }


/**
 * Ajoute les comportement au éléments
 */
bindEvents() {

  this.form.querySelectorAll('input').forEach(input => {
    input.addEventListener('change' , this.loadForm.bind(this))
  })
}

async  loadForm () {
  const data = new FormData(this.form)
  const url = new URL(this.form.getAttribute('action') || window.location.href)
  const params = new URLSearchParams()
  data.forEach((value,key) => {
    params.append(key , value)
  })
  return this.loadUrl(url.pathname + '?' + params.toString())

}


async  loadUrl (url) {
  const ajaxUrl = url + "&ajax=1"
  const response = await fetch(ajaxUrl , {
    headers : {
      'X-Requested-With' : 'XMLHttpRequest'
    }
  }) 
  if (response.status >=200 && response.status  < 300 ){
    const data = await response.json()
    this.content.innerHTML = data.content
    this.flipContent(data.content)
    history.replaceState({}, '', url)
  } else {
    console.error(response)
  }
}

/**
 * Remplace les éléments de la grille avec un effet flip
 * @param {string} content 
 */

flipContent (content) {
  const exitSpring = function (element , index , onComplete ){
    spring({
      config: 'stiff',
      values: {
        translateY: [0, -20],
        opacity: [1, 0]
      },
      onUpdate: ({ translateY, opacity }) => {
        element.style.opacity = opacity;
        element.style.transform = `translateY(${translateY}px)`;
      },
      onComplete 
    })
  }

  const appearSpring = function (element , index  ){
    spring({
      config: 'stiff',
      values: {
        translateY: [20 , 0],
        opacity: [0 , 1]
      },
      onUpdate: ({ translateY, opacity }) => {
        element.style.opacity = opacity;
        element.style.transform = `translateY(${translateY}px)`;
      },
      delay: index * 20
    })
  }

  const flipper = new Flipper ({
    element : this.content
  })
  Object.values(this.content.children).forEach(element => {
    flipper.addFlipped({
      element,
      flipId : element.id,  
      shouldFlip : false,
      onExit : exitSpring,
    })
  })
  flipper.recordBeforeUpdate()
  this.content.innerHTML = content
  Object.values(this.content.children).forEach(element => {
    flipper.addFlipped({
      element,
      flipId :  element.id,
      onAppear : appearSpring
    })
  })
  flipper.update()


}

}
