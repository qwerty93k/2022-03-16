
{{-- 
    1. Sukuriame lentele x
    2. VYkdome ajax uzklausa kurios nuoroda eina i serverio puse http://127.0.0.1:8000/api/clients
    3. AJAX atsakyma json masyva
    4. mes su jquery/javascript galime lengvai uzpildyti susikurta lentele
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Client-side</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Styles -->
    </head>
    <body class="antialiased">
        <div class="container">
            <button id="show-create-client-modal" data-bs-toggle="modal" data-bs-target="#createClientModal" >Create Client</button>
            
            
            <table id="clients" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
            <button id="page1" data-page="4"> Go To Page 4 </button>
            <div class="button-container">
            </div>

            <table class="template d-none">
                <tr>
                    <td class="col-client-id"></td>
                    <td class="col-client-name"></td>
                    <td class="col-client-surname"></td>
                    <td class="col-client-description"></td>
                    <td>
                        <button class="btn btn-danger delete-client" type="submit" data-clientid="">DELETE</button>
                        <button type="button" class="btn btn-primary show-client" data-bs-toggle="modal"
                            data-bs-target="#showClientModal" data-clientid="">Show</button>
                        <button type="button" class="btn btn-secondary edit-client" data-bs-toggle="modal"
                            data-bs-target="#editClientModal" data-clientid="">Edit</button>
                    </td>
                </tr>
            </table>

        </div>
        <div class="modal fade" id="createClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Modal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="ajaxForm">
                    <div class="form-group">
                        <label for="client_name">Client Name</label>
                        {{-- is-invalid ant inputo --}}
                        <input id="client_name" class="form-control create-input" type="text" name="client_name" />
                        
                        <span class="invalid-feedback input_client_name">
                        </span>
                      </div>
                    <div class="form-group">
                        <label for="client_surname">Client Surname</label>
                        <input id="client_surname" class="form-control create-input" type="text" name="client_surname" />
                        <span class="invalid-feedback input_client_surname">
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="client_description">Client Description</label>
                        <input id="client_description" class="form-control create-input" type="text" name="client_description" />
                        <span class="invalid-feedback input_client_description">
                        </span>  
                    </div>
                    {{-- <div class="form-group">
                      <label for="client_company_id">Client Company</label>
                      <select id="client_company_id" class="form-select create-input">
                        @foreach ($companies as $company)
                          <option value="{{$company->id}}">{{$company->title}}</option>
                        @endforeach
                      </select>
                      <span class="invalid-feedback input_client_company_id"> </span> 
                    </div> --}}
                </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button id="close-client-create-modal" type="button" class="btn btn-secondary">Close with Javascript</button> --}}
                    <button id="create-client" type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>    
        
        
          <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Modal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="ajaxForm">
                    <input type="hidden" id="edit_client_id" name="client_id" />
                    <div class="form-group">
                        <label for="client_name">Client Name</label>
                        <input id="edit_client_name" class="form-control" type="text" name="client_name" />
                    </div>
                    <div class="form-group">
                        <label for="client_surname">Client Surname</label>
                        <input id="edit_client_surname" class="form-control" type="text" name="client_surname" />
                    </div>
                    <div class="form-group">
                        <label for="client_description">Client Description</label>
                        <input id="edit_client_description" class="form-control" type="text" name="client_description" />
                    </div>
                    {{-- <div class="form-group">
                      <label for="client_description">Client Company id</label>
                      <select id="edit_client_company_id" class="form-select">
                        @foreach ($companies as $company)
                          <option class="company{{$company->id}}" value="{{$company->id}}">{{$company->title}}</option>
                        @endforeach
                      </select>  
                    </div> --}}
                </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button id="close-client-create-modal" type="button" class="btn btn-secondary">Close with Javascript</button> --}}
                    <button id="update-client" type="button" class="btn btn-primary update-client">Update</button>
                </div>
              </div>
            </div>
          </div>
        
        <script>

            $(document).ready(function(){
                console.log('jquery veikia');
            })

            let csrf = '123456789';

            function createRowFromHtml(clientId, clientName, clientSurname, clientDescription) {
                $(".template tr").removeAttr("class");
                $(".template tr").addClass("client" + clientId);
                $(".template .delete-client").attr('data-clientid', clientId);
                $(".template .show-client").attr('data-clientid', clientId);
                $(".template .edit-client").attr('data-clientid', clientId);
                $(".template .col-client-id").html(clientId);
                $(".template .col-client-name").html(clientName);
                $(".template .col-client-surname").html(clientSurname);
                $(".template .col-client-description").html(clientDescription);
                // $(".template .col-client-company").html(clientCompanyId);

                return $(".template tbody").html();
            }
            // .button-container button
            $(document).on('click', '.button-container button',function() {

                let page= $(this).attr('data-page');
                console.log(page);
                $.ajax({
                    type: 'GET',
                    url: page,
                    data: {csrf:csrf},
                    success: function(data) {
                        $('#clients tbody').html('');
                        $('.button-container').html('');

                       $.each(data.data, function(key, client) {
                    
                           let html;
                           html = createRowFromHtml(client.id, client.name, client.surname, client.description);
                           $('#clients tbody').append(html);
                       });

                       $.each(data.links, function(key, link) {

                            let button;
                            if (link.url != null) {
                                if(link.active == true) {
                                    button = "<button class='btn btn-primary active type='button' data-page='"+link.url +"'>" + link.label+" </button>";
                                } else {
                                    button = "<button class='btn btn-primary' type='button' data-page='"+link.url +"'>" + link.label+" </button>";
                                }
                            }
                            $('.button-container').append(button);
                       });
                        console.log(data)
                    }
                });
            });

            $.ajax({
                    type: 'GET',
                    url: 'http://127.0.0.1:8000/api/clients',
                    data: {csrf:csrf},
                    success: function(data) {
                        $.each(data.data, function(key, client) {
                    
                        let html;
                        html = createRowFromHtml(client.id, client.name, client.surname, client.description);
                        $('#clients tbody').append(html);
                        });
                       console.log(data.links)
                       $.each(data.links, function(key, link) {
                            let button;
                            if (link.url != null) { 
                                if(link.active == true) {
                                    button = "<button class='btn btn-primary active' type='button' data-page='"+link.url +"'>" + link.label+" </button>";
                                }
                                else {
                                    button = "<button class='btn btn-primary' type='button' data-page='"+link.url +"'>" + link.label+" </button>";
                                }
                            }
                            $('.button-container').append(button);
                       });
                    }
            });
            //POST
            //GET
            //PUT
            //DELETE

            //tai yra 4 atskiri kanalai, kurie yra serveryje
            // /api/clients - 4 kanalai

            // /api/clients - POST 
            // /api/clients - GET
            // /api/clients - PUT
            // /api/clients - DELETE
            //


            $(document).on('click', '#create-client', function() {
                let client_name = $('#client_name').val();
                let client_surname = $('#client_surname').val();
                let client_description = $('#client_description').val();
                $.ajax({
                        type: 'POST',
                        url: 'http://127.0.0.1:8000/api/clients',
                        data: {client_name:client_name, client_surname:client_surname, client_description:client_description },
                        success: function(data) {
                            console.log(data)
                        }
                });

                $.ajax({
                    type: 'GET',
                    url: 'http://127.0.0.1:8000/api/clients',
                    data: {csrf:csrf},
                    success: function(data) {
                        $('#clients tbody').html('');
                        $('.button-container').html('');
                        $.each(data.data, function(key, client) {
                    
                        let html;
                        html = createRowFromHtml(client.id, client.name, client.surname, client.description);
                        $('#clients tbody').append(html);
                        });
                       console.log(data.links)
                       $.each(data.links, function(key, link) {
                            let button;
                            if (link.url != null) { 
                                if(link.active == true) {
                                    button = "<button class='btn btn-primary active' type='button' data-page='"+link.url +"'>" + link.label+" </button>";
                                }
                                else {
                                    button = "<button class='btn btn-primary' type='button' data-page='"+link.url +"'>" + link.label+" </button>";
                                }
                            }
                            $('.button-container').append(button);
                       });
                    }
                });
            })




            // update-client
            $(document).on('click', '#update-client',function() {
                let clientid = $('#edit_client_id').val();
                let client_name = $('#edit_client_name').val();
                let client_surname = $('#edit_client_surname').val() ;
                let client_description = $('#edit_client_description').val() ;
                $.ajax({
                        type: 'PUT',
                        url: 'http://127.0.0.1:8000/api/clients/'+clientid,//
                        data: {client_name:client_name, client_surname:client_surname, client_description:client_description },
                        success: function(data) {
                            console.log(data)
                        }
                });
            });


            $(document).on('click', '.edit-client',function() {
                let clientid = $(this).attr('data-clientid');
                $.ajax({
                    type: 'GET',
                    url: 'http://127.0.0.1:8000/api/clients/'+clientid,//
                    success: function(data) {
                        $('#edit_client_id').val(data.id);
                        $('#edit_client_name').val(data.name);
                        $('#edit_client_surname').val(data.surname);
                        $('#edit_client_description').val(data.description);
                    }
                });
            });

            $(document).on('click', '.delete-client',function() {
                let clientid = $(this).attr('data-clientid');
                $.ajax({
                    type: 'DELETE',
                    url: 'http://127.0.0.1:8000/api/clients/'+clientid,//
                    success: function(data) {
                       console.log(data)
                    }
                });
            })
            
            



        </script>
    </body>
</html>
