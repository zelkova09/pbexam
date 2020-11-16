<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Expenses</h1>
        </div>

    <button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewExpensesModal"><i class="fas fa-plus"></i>Add New Expense</button>

        <!-- Content Row -->
        <div class="row">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Expenses Log
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount Entered</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Current Balance</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(expense, index) in expenses" :key="index">
                                    <th scope="row">{{expense.id}}</th>
                                    <td>{{expense.name}}</td>
                                    <td>{{expense.description}}</td>
                                    <td>{{expense.amount_entered}}</td>
                                    <td>{{expense.budget}}</td>
                                    <td>{{expense.current_balance}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning"  v-on:click="editExpense(expense)">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button type="button"  class="btn btn-danger" v-on:click="deleteExpenses(expense)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h6 class="m-0 font-weight-bold text-primary">
                                Revenue Sources
                            </h6>
                            <div class="dropdown no-arrow">
                                <a
                                    class="dropdown-toggle"
                                    href="#"
                                    role="button"
                                    id="dropdownMenuLink"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i
                                        class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                                    ></i>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink"
                                >
                                    <div class="dropdown-header">
                                        Dropdown Header:
                                    </div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#"
                                        >Another action</a
                                    >
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"
                                        >Something else here</a
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i>
                                    Direct
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i>
                                    Social
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i>
                                    Referral
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Content Column -->
                <div class="col-lg-6 mb-4"></div>
            </div>
        </div>

        <!----------------- ADD M O D A L STARTS HERE -------------------->
        <b-modal ref="newExpensesModal" hide-footer title="Add new Expense">
            <div class="d-block text-center">
                <form v-on:submit.prevent="createExpenses">
                      <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" v-model="expensesData.name" class="form-control" id="name" placeholder="Enter Name">
                            <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" v-model="expensesData.description" class="form-control" id="description" placeholder="Description">
                            <div class="invalid-feedback" v-if="errors.description">{{errors.description[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="amount_entered">Enter Amount</label>
                            <input type="text" v-model="expensesData.amount_entered" class="form-control" id="amount_entered" placeholder="PHP">
                            <div class="invalid-feedback" v-if="errors.amount_entered">{{errors.amount_entered[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="budget">Budget</label>
                            <input type="text" v-model="expensesData.budget" class="form-control" id="budget" placeholder="PHP">
                            <div class="invalid-feedback" v-if="errors.budget">{{errors.budget[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="current_balance">Current Balance</label>
                            <input type="text" v-model="expensesData.current_balance" class="form-control" id="current_balance" placeholder="PHP">
                            <div class="invalid-feedback" v-if="errors.current_balance">{{errors.current_balance[0]}}</div>
                        </div>
                        <hr>
                        <div class="text-right">
                            <button type="button" class="btn btn-warning" v-on:click="hideNewExpensesModal">Close</button>
                            <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Save</button>
                        </div>
                </form>
            </div>
        </b-modal>

        <!----------------- EDIT M O D A L STARTS HERE -------------------->
         <b-modal ref="editExpensesModal" hide-footer title="Edit Expenses Details">
            <div class="d-block text-center">
                <form v-on:submit.prevent="updateExpense">
                      <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" v-model="editExpensesData.name" class="form-control" id="name" placeholder="Enter Name">
                            <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" v-model="editExpensesData.description" class="form-control" id="description" placeholder="Description">
                            <div class="invalid-feedback" v-if="errors.description">{{errors.description[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="amount_entered">Enter Amount</label>
                            <input type="text" v-model="editExpensesData.amount_entered" class="form-control" id="amount_entered" placeholder="PHP">
                            <div class="invalid-feedback" v-if="errors.amount_entered">{{errors.amount_entered[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="budget">Budget</label>
                            <input type="text" v-model="editExpensesData.budget" class="form-control" id="budget" placeholder="PHP">
                            <div class="invalid-feedback" v-if="errors.budget">{{errors.budget[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label for="current_balance">Current Balance</label>
                            <input type="text" v-model="editExpensesData.current_balance" class="form-control" id="current_balance" placeholder="PHP">
                            <div class="invalid-feedback" v-if="errors.current_balance">{{errors.current_balance[0]}}</div>
                        </div>
                        <hr>
                        <div class="text-right">
                            <button type="button" class="btn btn-warning" v-on:click="hideEditExpensesModal">Close</button>
                            <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Update</button>
                        </div>
                </form>
            </div>
         </b-modal>  

    </div>
    <!-- /.container-fluid -->
</template>

<script>
import * as expensesService from '../services/expenses_service';
export default {
    name: 'expenses',
    data() {
        return {
            expenses: [],
            expensesData: {
                name: '',
                description: '',
                amount_entered: '',
                budget: '',
                current_balance: ''
            },
            editExpensesData:{},
            errors:{}
        }
    },
    mounted(){
        this.loadExpenses();
    },

    methods:{
        hideNewExpensesModal(){
            this.$refs.newExpensesModal.hide();
        },
        showNewExpensesModal(){
            this.$refs.newExpensesModal.show();
        },

        loadExpenses: async function(){
            try {
                const response = await expensesService.loadExpenses();
                this.expenses = response.data.data;
            } catch (error) {
                this.flashMessage.error({
                            message: 'Expenses Error, Refresh!',
                            time: 5000
                        });
            }
        },

        createExpenses: async function(){
           let formData = new FormData();
           formData.append('name', this.expensesData.name);
           formData.append('description', this.expensesData.description);
           formData.append('amount_entered', this.expensesData.amount_entered);
           formData.append('budget', this.expensesData.budget);
           formData.append('current_balance', this.expensesData.current_balance);

           try{
               const response = await expensesService.createExpenses(formData);
               this.expenses.unshift(response.data);
               this.hideNewExpensesModal();
                        this.flashMessage.success({
                            message: 'Expenses Added!',
                            time: 5000
                        });

                this.expensesData = {
                    name: '',
                    description: '',
                    amount_entered: '',
                    budget: '',
                    current_balance: ''
            };

           } catch(error){
               switch (error.response.status) {
                   case 422:
                       this.errors = error.response.data.errors;
                       break;
                   default:
                       this.flashMessage.error({
                            message: 'Expenses Error!',
                            time: 5000
                         });
                       break;
               }
           }
        },

        deleteExpenses: async function(expense){
            if (!window.confirm(`Are you sure to delete this Expense? ${expense.description} by ${expense.name}`)){
                return;
            }

            try {
                await expensesService.deleteExpenses(expense.id);
                this.expenses = this.expenses.filter(obj => {
                    return obj.id != expense.id;
                });
            } catch (error) {
                
            }
        },

        hideEditExpensesModal() {
            this.$refs.editExpensesModal.hide();
        },
        showEditExpensesModal() {
            this.$refs.editExpensesModal.show();
        },
        editExpense(expense) {
            this.editExpensesData = expense;
            this.showEditExpensesModal();
        },
        

        updateExpense: async function(){
            try {
                let frmData = new FormData();
                frmData.append('name', this.editExpensesData.name);
                frmData.append('description', this.editExpensesData.description);
                frmData.append('amount_entered', this.editExpensesData.amount_entered);
                frmData.append('budget', this.editExpensesData.budget);
                frmData.append('current_balance', this.editExpensesData.current_balance);
                frmData.append('_method', 'put');
                const response = await expensesService.updateExpense(this.editExpensesData.id, frmData);
                 this.hideEditExpensesModal();
                        this.flashMessage.success({
                            message: 'Expenses Edited!',
                            time: 5000
                        });

                this.expenses.map(expense => {
                        if (expense.id == response.data.id) {
                            for (let key in response.data) {
                                expense[key] = response.data[key];
                            }
                        }
                    });

            } catch(error){
               switch (error.response.status) {
                   case 422:
                       this.errors = error.response.data.errors;
                       break;
                   default:
                       this.flashMessage.error({
                            message: 'Expenses Error!',
                            time: 5000
                         });
                       break;
               }
           }
        }   
    }
}
</script>
