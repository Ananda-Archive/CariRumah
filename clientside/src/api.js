import axios from 'axios'

const productTable = 'products'
const promoTable = 'promo'
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
}

export default api