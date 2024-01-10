import axios from 'axios'

const Api = axios.create({
    baseURL: window.location.protocol + '//' + window.location.hostname  + ':8000/api',
    headers: {
        Authorization : `Bearer ${localStorage.getItem("XSRF-TOKEN")}`
        }
})

export default Api

