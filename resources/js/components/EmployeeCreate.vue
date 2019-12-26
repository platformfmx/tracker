<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create employee</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="/api/employees">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        <label for="exampleInputFirstName">First name</label>
                        <input type="text" name="first_name" class="form-control" id="exampleInputFirstName" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMiddleName">Middle name</label>
                        <input type="text" name="middle_name" class="form-control" id="exampleInputMiddleName" placeholder="Enter middle name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLastName">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="exampleInputLastName" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPersonalNumber">Personal number</label>
                        <input type="text" name="personal_number" class="form-control" id="exampleInputPersonalNumber" placeholder="Enter personal number" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPhone" placeholder="Enter phone" required>
                    </div>
                    <button type="submit"  class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmployeeCreate",
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),
    }
</script>

<style scoped>

</style>
