{{-- 
    1. Reikia suformuoti lentele.
    2. Vykdome ajax uzklausa kurios nuoroda eina i serverio puse. http://127.0.0.1:8000/api/clients
    3. AJAX atsakymas json masyvas
    4. Su jquery/js galime lengvai uzpildyti susikurta lentele gautais duomeninimis
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

            <button id="page1" data-page="4">Go to page 4</button>
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
                    <button type="button" class="btn btn-primary show-client" data-bs-toggle="modal" data-bs-target="#showClientModal" data-clientid="">Show</button>
                    <button type="button" class="btn btn-secondary edit-client" data-bs-toggle="modal" data-bs-target="#editClientModal" data-clientid="">Edit</button>
                  </td>
                </tr>  
            </table>  

        </div>    
        <script>
            $(document).ready(function(){
                console.log('jquery veikia');
            })

            function createRowFromHtml(clientId, clientName, clientSurname, clientDescription) {
            $(".template tr").removeAttr("class");
            $(".template tr").addClass("client"+clientId);
            $(".template .delete-client").attr('data-clientid', clientId );
            $(".template .show-client").attr('data-clientid', clientId );
            $(".template .edit-client").attr('data-clientid', clientId );
            $(".template .col-client-id").html(clientId );
            $(".template .col-client-name").html(clientName );
            $(".template .col-client-surname").html(clientSurname );
            $(".template .col-client-description").html(clientDescription );
            //$(".template .col-client-company").html( clientCompanyId);
    
          return $(".template tbody").html();
        }

        // .button-container button
        $(document).on('click', '.button-container button',function() {
                let page= $(this).attr('data-page');
                console.log(page);
                $.ajax({
                    type: 'GET',
                    url: page,
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
                            button = "<button class='btn btn-primary' type='button' data-page='"+link.url +"'>" + link.label+" </button>";
                            $('.button-container').append(button);
                       });
                        console.log(data)
                    }
                });
            });

        $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/api/clients?page=2',
                success: function(data) {
                    console.log(data);
                    $.each(data.links, function(key,link){
                        let button;
                        button = "<button class='btn btn-primary' type='button' data-page='"+link.url+"'>"+link.label+"</button>"
                        $('.button-container').append(button);
                    });
                }
        });
        </script>
    </body>
</html>