<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Employees list</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="/employees/create">
                    <button class="btn btn-success mb-4">Add employee</button>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h3>Filter</h3>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-2">
                <b>Coming date</b>
            </div>
            <div class="col-md-4">
                <datetime v-on:close="changeDate()" v-model="date"></datetime>
            </div>

            <div class="col-md-2">
                <b>Personal number</b>
            </div>
            <div class="col-md-4">
                <input type="text" v-on:input="filterResult()" v-model="query"  class="form-control" placeholder="Enter personal number">
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Personal Number</th>
                        <th scope="col">Phone</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="employee in employees">
                        <th scope="row">{{employee.id}}</th>
                        <th scope="row">{{employee.first_name}}</th>
                        <th scope="row">{{employee.last_name}}</th>
                        <th scope="row">{{employee.middle_name}}</th>
                        <th scope="row">{{employee.personal_number}}</th>
                        <th scope="row">{{employee.phone}}</th>
                        <th scope="row">
                            <a v-bind:href="getUrl('view',employee.id)">
                                <button class="btn btn-info">View</button>
                            </a>
                            <a v-bind:href="getUrl('update',employee.id)">
                                <button class="btn btn-warning">Edit</button>
                            </a>

                            <form class="d-inline-block" v-bind:action="getUrl('delete',employee.id)" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" :value="csrf">
                                <button class="btn btn-danger">Delete</button>
                            </form>

                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmployeesList",
        data() {
            return {
                employees: null,
                date: null,
                query: null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        methods: {
          getUrl: function(method, id) {
              if (method === "view") {
                  return "/employee/" + id;
              } else if (method === "update") {
                  return "/api/employees/" + id + '/edit';
              } else if(method === "delete") {
                  return "/api/employees/" + id;
              }
          },
          changeDate: function() {
              var url = '/api/employees/?filter=true';
              if(this.date) {
                  url += "&date=" + this.date
              }
              axios
                  .get(url)
                  .then(response => (this.employees = response.data));

          },
          filterResult() {
              var url = '/api/employees/?filter=true';
              if(this.query) {
                  url += "&personal_number=" + this.query
              }
              axios
                  .get(url)
                  .then(response => (this.employees = response.data));
          }
        },
        created() {
            axios
                .get('/api/employees')
                .then(response => (this.employees = response.data));
        }
    }
</script>

<style>

</style>
