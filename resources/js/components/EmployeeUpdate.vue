<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Update employee</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" v-if="employee" v-bind:action="getUpdateAction(employee.id)">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="exampleInputFirstName">First name</label>
                        <input type="text" name="first_name" class="form-control"
                               v-bind:value="employee.first_name"
                               id="exampleInputFirstName" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMiddleName">Middle name</label>
                        <input type="text" name="middle_name" class="form-control"
                               v-bind:value="employee.middle_name"
                               id="exampleInputMiddleName" placeholder="Enter middle name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLastName">Last name</label>
                        <input type="text" name="last_name" class="form-control"
                               v-bind:value="employee.last_name"
                               id="exampleInputLastName" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPersonalNumber">Personal number</label>
                        <input type="text" name="personal_number" class="form-control"
                               v-bind:value="employee.personal_number"
                               id="exampleInputPersonalNumber" placeholder="Enter personal number" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone">Phone</label>
                        <input type="text" name="phone" class="form-control"
                               v-bind:value="employee.phone"
                               id="exampleInputPhone" placeholder="Enter phone" required>
                    </div>
                    <button type="submit"  class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmployeeUpdate",
        data: () => ({
            employee: null,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),
        props: ['employeeId'],
        mounted () {
            axios
                .get('/api/employees/'+this.employeeId)
                .then(response => (this.employee = response.data));
        },
        methods: {
            getUpdateAction(id) {
                return "/api/employees/" + id;
            }
        }
    }
</script>

<style scoped>

</style>
