<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Web Look</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/main.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="css/materialdesignicons.min.css" rel="stylesheet">
    <link href="css/vuetify.css" rel="stylesheet">

    <meta name="theme-color" content="#fafafa">

</head>

<body>
    <div id="app">
        <v-app style="background: linear-gradient(to right, #FFAF7B, #D76D77, #3A1C71);">
            <v-main>
                <v-container>
                    <v-row>
                        <v-col>
                            <v-container>
                                <v-row>
                                    <v-col>
                                      
                                            <v-container>
                                                <v-row>
                                                    <v-col>
                                                        <v-col class="d-flex justify-space-around">
                                                            <v-btn class="ma-2 title"   color="info"
                                                                @click="dialog=true">
                                                                <v-icon left>mdi-plus</v-icon> Add Todo
                                                            </v-btn>
                                                        </v-col>

                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                     
                                    </v-col>
                                    <v-col class="d-flex align-end mb-6">
                                        <v-container fluid>
                                            <v-card class="pa-2">
                                                <v-text-field class="pa-2" v-model="search" append-icon="mdi-magnify"
                                                    label="Search" single-line hide-details></v-text-field>
                                            </v-card>
                                        </v-container>
                                    </v-col>
                                </v-row>
                            </v-container>
                            <v-sheet min-height="80vh" rounded="lg">
                                <v-container fluid>
                                    <v-container fluid>
                                        <v-row>
                                            <v-col>
                                                <v-data-table :headers="headers" :items="todolist" :search="search">
                                                <template v-slot:item.action="{ item }">
                                                        <v-btn class="ma-4 ml-1" outlined color="indigo" @click="openedittodo(item)">
                                                            <v-icon left>mdi-pencil-outline</v-icon>Edit
                                                        </v-btn>
                                                        <v-btn class="ma-4 ml-1" outlined color="indigo" @click="removetodo(item)">
                                                            <v-icon left>mdi-close-circle</v-icon>Remove
                                                        </v-btn>
                                                    </template>
                                                </v-data-table>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-container>
                            </v-sheet>
                        </v-col>
                    </v-row>
                </v-container>
                <v-dialog v-model="dialog" max-width="1100px" persistent>
                    <v-card>
                        <v-container>
                            <v-card-title>
                                <span class="headline">Add New Todo</span>
                                <v-spacer></v-spacer>
                            </v-card-title>
                            <v-container>
                                <v-form ref="form" v-model="valid" lazy-validation>
                                    <v-row>
                                        <v-col>
                                            <v-select :items="itemsStatus" v-model="todoStatus" filled label="Status">
                                            </v-select>
                                        </v-col>
                                    </v-row>
                                    <v-row>

                                        <v-col>
                                            <v-text-field v-model="newTodoDes" label="Please enter new todo"
                                                :rules="[v => !!v || 'todo is required']" clearable></v-text-field>
                                        </v-col>
                                    </v-row>
                                    </v-row>
                                </v-form>
                            </v-container>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closenewtodo()">Close</v-btn>
                                <v-btn color="blue darken-1" text @click="submitnewtodo()">Submit</v-btn>
                            </v-card-actions>
                        </v-container>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialog1" max-width="1100px" persistent>
                    <v-card>
                        <v-container>
                            <v-card-title>
                                <span class="headline">Edit New Todo</span>
                                <v-spacer></v-spacer>
                            </v-card-title>
                            <v-container>
                                <v-form ref="form1" v-model="valid1" lazy-validation>
                                    <v-row>
                                        <v-col>
                                            <v-select :items="itemsStatus" v-model="temptodoStatus" filled label="Status">
                                            </v-select>
                                        </v-col>
                                    </v-row>
                                    <v-row>

                                        <v-col>
                                            <v-text-field v-model="tempnewTodoDes" label="Please enter new todo"
                                                :rules="[v => !!v || 'todo is required']" clearable></v-text-field>
                                        </v-col>
                                    </v-row>
                                    </v-row>
                                </v-form>
                            </v-container>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeedittodo()">Close</v-btn>
                                <v-btn color="blue darken-1" text @click="submitedittodo()">Edit</v-btn>
                            </v-card-actions>
                        </v-container>
                    </v-card>
                </v-dialog>
            </v-main>
        </v-app>
    </div>
    <script src="js/vue.js"></script>
    <script src="js/vuetify.js"></script>
    <script src="js/axios.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/main.js"></script>
    <script>
    var application = new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data: {
            page: 0,
            dialog: false,
            dialog1:false,
            valid: false,
            valid1:false,
            links: [
                'Dashboard',
                'Empty1',
                'Empty2',
                'Empty3',
            ],
            menu: false,
            todolist: [],
            newTodoDes: null,
            temptodoStatus:null,
            todoStatus: null,
            tempnewTodoDes:null,
            itemsStatus: ['New', 'In Progress', 'Completed'],
            search: "",
            headers: [{
                    text: 'Todo ID',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },
                {
                    text: 'Todo Description',
                    value: 'todoDescription'
                },
                {
                    text: 'Status',
                    value: 'status'
                },
                {
                    text: 'Action',
                    value: 'action'
                },
            ],
        },
        methods: {
            removetodo: function(v){
                axios.post('action.php', {
                            action: 'deleteTodo',
                            todoID: v.id
                        }).then(function(response) {
                            console.log(response.data);
                            application.gettodo();
                        });
            },
            submitnewtodo: function() {
                if (application.$refs.form.validate()) {
                    if (application.newTodoDes != '' && application.todoStatus != '') {
                        axios.post('action.php', {
                            action: 'insertTodo',
                            ntodoDesc: application.newTodoDes,
                            ntodostatus: application.todoStatus
                        }).then(function(response) {
                            application.closenewtodo();
                            console.log(response.data);
                            application.gettodo();
                        });
                    }
                }
            },
            closeedittodo: function() {
                application.$refs.form1.reset();
                application.dialog1 = false;
            },
            closenewtodo: function() {
                application.$refs.form.reset();
                application.dialog = false;
            },
            submitedittodo: function(){
                if (application.$refs.form1.validate()) {
                    if (application.temptodoStatus != '' && application.tempnewTodoDes != '') {
                        axios.post('action.php', {
                            action: 'editTodo',
                            todoID: application.temptodoid,
                            todoStatus: application.temptodoStatus,
                            todoDes: application.tempnewTodoDes
                        }).then(function(response) {
                            application.closeedittodo();
                            console.log(response.data);
                            application.gettodo();
                        });
                    }
                }
            },
            openedittodo(item){
                application.temptodoid=item.id;
                application.tempnewTodoDes=item.todoDescription;
                application.temptodoStatus=item.status;
                application.dialog1=true;
            },
            gettodo: function() {
                axios.post('getdata.php', {
                    action: 'getTodo'
                }).then(function(response) {
                    application.todolist = response.data;
                });
            },
        },
        created: function() {
            this.gettodo();

        },
    })
    </script>
</body>

</html>

</html>