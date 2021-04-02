/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} sorting
 * @property {HTMLElement} content
 * @property {HTMLFormElement} form
 */
export default class Filter
{
    /**
     * 
     * @param {HTMLElement|null} element 
     * @returns 
     */
    constructor(element){
        if(element === null){
            return
        }
        this.pagination = element.querySelector('.js-filter-pagination')
        this.sorting = element.querySelector('.js-filter-sorting')
        this.content = element.querySelector('.js-filter-content')
        this.form = element.querySelector('.js-filter-form')

        this.bindEvents()
    }

    bindEvents(){
        // this.sorting.querySelectorAll('a').forEach(a => {
        //     a.addEventListener('click', e => { 
        //         e.preventDefault()
        //         this.loadUrl(a.getAttribute('href'))
        //     })
        // })
        // this.sorting.querySelectorAll('a').forEach(a => {
        //     a.addEventListener('click', e => { 
        //         e.preventDefault()
        //         this.loadUrl(a.getAttribute('href'))
        //     })
        // })
        const aClickListener = e => {
            if(e.target.tagName === 'A'){
                
            }
        }
        this.form.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this))
        })

        this.pagination.addEventListener('click', e => {

        })
    }
    async loadForm(){
        
        const data = new FormData(this.form)
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadUrl(url.pathname + '?' + params.toString())
    }

    async loadUrl(url){
        const ajaxUrl = url + '&ajax=1'
        const response = await fetch(ajaxUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if(response.status >= 200 && response.status < 300){
            const data = await response.json()
            this.content.innerHTML = data.content
            history.replaceState({}, '', url)
            //pusState
        }
        else{
            console.error(response)
        }
    }
}