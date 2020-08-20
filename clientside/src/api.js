import axios from 'axios'

const productTable = 'products'
const promoTable = 'promo'
const articleTable = 'article'
const imageAPI = 'image'
const aboutTable = 'about'
const insertSuccessMessage = 'Berhasil ditambahkan'
const updateSuccessMessage = 'Berhasil diperbarui'
const deleteSuccessMessage = 'Berhasil dihapus'
// const insertFailedMessage = 'Gagal ditambahkan'
const serverErrorMessage = 'Terjadi kesalahan pada server'
const deleteFailedMessage = 'Gagal dihapus'
// const existErrorMessage = 'Sudah terdaftar'

const api = {
    createProduct(product) {
        return new Promise ((resolve, reject) => {
            axios.post(productTable, product)
                .then(() => {
                    resolve(insertSuccessMessage)
                }) .catch(err => {
                    if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    getAllProduct() {
        return new Promise ((resolve, reject) => {
            axios.get(productTable)
                .then((response) => {
                    resolve(response.data)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    updateProduct(product) {
        return new Promise ((resolve, reject) => {
            axios.put(productTable, product)
                .then(() => {
                    resolve(updateSuccessMessage)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    deleteProduct(id) {
        return new Promise( (resolve, reject) => {
            axios.delete(productTable, {params: {id: id}})
                .then(() => {
                    resolve(deleteSuccessMessage)
                }) .catch(err => {
                    if(err.response.status == 500) reject(serverErrorMessage)
                    else reject(deleteFailedMessage)
                })
        } )
    },
    createPromo(promo) {
        return new Promise ((resolve, reject) => {
            axios.post(promoTable, promo)
                .then(() => {
                    resolve(insertSuccessMessage)
                }) .catch(err => {
                    if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    getAllPromo() {
        return new Promise ((resolve, reject) => {
            axios.get(promoTable)
                .then((response) => {
                    resolve(response.data)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    updatePromo(promo) {
        return new Promise ((resolve, reject) => {
            axios.put(promoTable, promo)
                .then(() => {
                    resolve(updateSuccessMessage)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    deletePromo(id) {
        return new Promise( (resolve, reject) => {
            axios.delete(promoTable, {params: {id: id}})
                .then(() => {
                    resolve(deleteSuccessMessage)
                }) .catch(err => {
                    if(err.response.status == 500) reject(serverErrorMessage)
                    else reject(deleteFailedMessage)
                })
        } )
    }, 
    createArticle(article) {
        return new Promise ((resolve, reject) => {
            axios.post(articleTable, article)
                .then(() => {
                    resolve(insertSuccessMessage)
                }) .catch(err => {
                    if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    getAllArticle() {
        return new Promise ((resolve, reject) => {
            axios.get(articleTable)
                .then((response) => {
                    resolve(response.data)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    updateArticle(article) {
        return new Promise ((resolve, reject) => {
            axios.put(articleTable, article)
                .then(() => {
                    resolve(updateSuccessMessage)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    deleteArticle(id) {
        return new Promise( (resolve, reject) => {
            axios.delete(articleTable, {params: {id: id}})
                .then(() => {
                    resolve(deleteSuccessMessage)
                }) .catch(err => {
                    if(err.response.status == 500) reject(serverErrorMessage)
                    else reject(deleteFailedMessage)
                })
        } )
    },
    uploadImage(image) {
        return new Promise( (resolve, reject) => {
            const data = new FormData()
            data.append('image',image)
            axios.post(imageAPI, data, {headers: {'Content-Type': 'multipart/form-data'}})
                .then((response) => {
                    resolve(response.data)
                }) .catch(err => {
                    if(err.response.status == 500) reject(serverErrorMessage)
                })
        } )
    },
    getAllAbout() {
        return new Promise ((resolve, reject) => {
            axios.get(aboutTable)
                .then((response) => {
                    resolve(response.data)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },
    updateAbout(about) {
        return new Promise ((resolve, reject) => {
            axios.put(aboutTable, about)
                .then(() => {
                    resolve(updateSuccessMessage)
                }) .catch(err => {
                        if(err.response.status == 500) reject(serverErrorMessage)
                })
        })
    },   
}

export default api