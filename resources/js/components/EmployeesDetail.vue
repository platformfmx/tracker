<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Employee page</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a  v-if="employee" v-bind:href="getUrl('update',employee.id)">
                    <button class="btn btn-success mb-4">Edit employee</button>
                </a>
                <form v-if="employee" class="d-inline-block" v-bind:action="getUrl('delete',employee.id)" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" :value="csrf">
                    <button class="btn btn-danger mb-4">Delete</button>
                </form>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary" v-if="!showForm" v-on:click="showForm = true">Add visit</button>
                <div class="mb-4 mt-4" v-if="showForm">
                    <div class="col-md-6">
                        <b>Coming date</b>
                        <datetime v-model="coming"></datetime>
                    </div>
                    <div class="col-md-6">
                        <b>Leaving date</b>
                        <datetime  v-model="leaving"></datetime>
                    </div>
                    <div class="col-md-12">
                        <button v-on:click="addVisit()" class="btn btn-success mt-2">Add visit</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card w-100" style="width: 18rem;" v-if="employee">
                    <div class="card-header">
                        Employee Card
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>First name: </b> {{employee.first_name}}
                        </li>
                        <li class="list-group-item">
                            <b>Middle name: </b> {{employee.middle_name}}
                        </li>
                        <li class="list-group-item">
                            <b>Last name: </b> {{employee.last_name}}
                        </li>
                        <li class="list-group-item">
                            <b>Personal number: </b> {{employee.personal_number}}
                        </li>
                        <li class="list-group-item">
                            <b>Phone: </b> {{employee.phone}}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <table class="table table-striped table-dark table" v-if="employee && employee.visits">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Coming</th>
                        <th scope="col">Leaving</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="visit in employee.visits">
                        <th scope="row">{{visit.id}}</th>
                        <th scope="row">{{visit.coming}}</th>
                        <th scope="row">{{visit.leaving}}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmployeesDetail",
        data() {
            return {
                employee: null,
                coming: null,
                leaving: null,
                showForm: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        props: ['employeeId'],
        mounted () {
            axios
                .get('/api/employees/'+this.employeeId)
                .then(response => (this.employee = response.data));
        },
        methods: {
            addVisit: function() {
                axios
                    .get('/add-visit/?id='+this.employee.id +'&coming=' + this.coming + '&leaving=' + this.leaving)
                    .then(response => (this.employee = response.data));
                this.showForm = false;
            },
            getUrl: function(method,id) {
                if(method === "delete") {
                    return "/api/employees/" + id;
                } else if (method === "update") {
                    return "/api/employees/" + id + '/edit';
                }
            }
        }
    }
</script>

<style scoped>

</style>
