<template>
    <div>
        <!-- Search form -->
        <div class="row">
            <div class="col col-12">
                <form action="#"  method="get" class="form-group">
                    <div class="row">
                        <input type="text" placeholder="Search By name, By City, By Adrres" name="search" v-model="search" @input="search_query" class="form-control col-8">
                        <input type="button" @click="search_query" class="btn btn-success form-control col-4 " value="Buscar">
                    </div>
                </form>
            </div>
        </div>

        <hr>
        <!-- The Modal -->
        <div class="modal fade" id="myModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="modoEditar">Editar hotel</h4>
                        <h4 v-else>Agregar Hotel</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form @submit.prevent="editar(hotel)" v-if="modoEditar">
                            <!-- Editar hotel -->
                            <input type="text" class="form-control mb-2"
                                   placeholder="Nombre del Hotel" v-model="hotel.name">
                            <input type="text" class="form-control mb-2"
                                   placeholder="Direccion del Hotel" v-model="hotel.address">
                            <input type="text" class="form-control mb-2"
                                   placeholder="Ciudad" v-model="hotel.city">
                            <input type="number" class="form-control-range" v-model="hotel.starts">

                            <button class="btn btn-warning" type="submit">Editar</button>
                            <button class="btn btn-danger" type="submit"
                                    @click="cancelarEdicion">Cancelar
                            </button>
                        </form>
                        <form @submit.prevent="agregar" v-else>
                            <!--Agregar nota {name: '', address: '', city:'', starts : 1, group_hotel_id: null};-->
                            <div class="form-group">
                                <label for="input_add_hotel_group">Grupo Hotelero</label>
                                <select class="form-control form-control-sm" v-model="hotel.group_hotel_id" id="input_add_hotel_group">
                                    <option v-for="option in groups" v-bind:value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="input_add_hotel">Nombre</label>
                                <input type="text"
                                       class="form-control form-control-sm"
                                       id="input_add_hotel"
                                       v-model="hotel.name"
                                       placeholder="Nombre del Hotel">
                            </div>
                            <div class="form-group">
                                <label for="input_add_hotel_address">Direccion</label>
                                <input type="text"
                                       class="form-control form-control-sm"
                                       id="input_add_hotel_address"
                                       v-model="hotel.address"
                                       placeholder="Direccion">
                            </div>
                            <div class="form-group">
                                <label for="input_add_hotel_city">Ciudad</label>
                                <input type="text"
                                       class="form-control form-control-sm"
                                       id="input_add_hotel_city"
                                       v-model="hotel.city"
                                       placeholder="Bogota">
                            </div>
                            <div class="form-group">
                                <label for="input_add_hotel_city">Estrellas</label>
                                <select class="form-control form-control-sm" v-model="hotel.starts">
                                    <option selected>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Agregar</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Add Hotel -->
        <button type="button" @click="newformulario()" class="btn btn-primary">
            Adicionar Hotel
        </button>
        <hr>
        <h3>Hoteles</h3>
        <div class="row">
            <div class="col-sm-4"
                 v-for="(item, index) in hotels" :key="index">
                <div class="card" style="width: 18rem;">
                    <img  :src="item.image" @error="imageUrlAlt" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{item.name}}</h5>
                        <h2>
                            <span :class="{ checked: item.starts>=1 }" class="fa fa-star"></span>
                            <span :class="{ checked: item.starts>=2 }"  class="fa fa-star"></span>
                            <span :class="{ checked: item.starts>=3 }"  class="fa fa-star"></span>
                            <span :class="{ checked: item.starts>=4 }"  class="fa fa-star"></span>
                            <span :class="{ checked: item.starts>=5 }" class="fa fa-star"></span>
                        </h2>
                        <h6 class="card-title">{{item.address}}</h6>
                        <p class="align-content-sm-stretch">{{item.city}}</p>
                        <p class="card-text">{{item.description}}</p>

                        <button class="btn btn-warning btn-sm"
                                @click="editarFormulario(item)">Editar
                        </button>
                        <button class="btn btn-danger btn-sm"
                                @click="eliminar(item, index)">Eliminar
                        </button>
                    </div>
                </div>


                <p></p>
                <p></p>
                <p>

                </p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "HotelComponent",
        data() {
            return {
                hotels: [],
                modoEditar: false,
                search: '',
                hotel: {name: '', description: ''},
                groups: [
                    {id:1, name:"A"}
                ]
            }
        },
        created() {
            let config = {
                headers: {
                    "Content-Type":"application/json",
                    "X-Requested-With":"XMLHttpRequest"
                }
            }
            axios.get('/api/hotels', config).then(res => {
                console.log(res.data.data)
                this.hotels = res.data.data;
            })
            axios.get('/api/hotelsgroups', config).then(res => {
                this.groups = res.data.data;
            })

        },
        methods: {
            search_query(eventSearch) {
                console.log(eventSearch)
                axios.get('/api/hotels?search='+this.search).then(res => {
                    console.log(res.data.data)
                    this.hotels = res.data.data;
                })
            },
            newformulario() {
                this.modoEditar = false;
                this.hotel = {name: '', address: '', city:'', starts : 1, group_hotel_id: null};
                $('#myModal').modal('show')
            },
            agregar() {
                const nuevoHotel = this.hotel;
                axios.post('/api/hotels', nuevoHotel)
                    .then((res) => {
                        const notaServidor = res.data;
                        this.hotels.push(notaServidor);
                        $('#myModal').modal('hide')
                    })
            },
            editarFormulario(item) {
                this.hotel = item;
                this.modoEditar = true;
                $('#myModal').modal('show')
            },
            editar(hotel) {
                const params = {name: hotel.name, address: hotel.address, city:hotel.city, starts : hotel.starts};
                axios.put(`api/hotels/${hotel.id}`, params)
                    .then(res => {
                        this.modoEditar = false;
                        $('#myModal').modal('hide')
                    })
            },
            eliminar(hotel, index) {
                const confirmacion = confirm(`Realmente desea ELiminar  el Hotel ${hotel.name}`);
                if (confirmacion) {
                    axios.delete(`/api/hotels/${hotel.id}`)
                        .then(() => {
                            this.hotels.splice(index, 1);
                        })
                }
            },
            cancelarEdicion() {
                this.modoEditar = false;
                this.hotel = {nombre: '', descripcion: ''};
            },
            imageUrlAlt(event) {
                console.log(event)
                event.target.src = "images/nologo.jpeg"
            }
        }
    }
</script>

<style scoped>
    .checked {
        color: orange;
    }

</style>
