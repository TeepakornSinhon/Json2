<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body>

    <button id="btnBack" style="margin:10px"> back </button>
    <div id="main">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th> Details </th>
                </tr>
            </thead>
            <tbody id="tblPosts">
            </tbody>
        </table>
    </div>

    <div id="detail" style="padding-top: 10px;"></div>
    <div id="comments">
        <h3>Comments</h3>
        <div id="list-comment"></div>
    </div>

</body>

<script>

    function showComments(id){
        var url = 'https://jsonplaceholder.typicode.com/posts/'+id+'/comments'
        $.getJSON(url)
            .done((data)=>{
                $.each(data, (key,item)=>{
                    var detail_comment = '<spawn>' + '<b>Name : </b>'+ item.name + '</spawn><br>'
                        detail_comment += '<spawn>' + '<b>Comment : </b>'+ item.body + '</spawn><br><br>'
                    $('#list-comment').append(detail_comment)
                })
            })
            .fail((xhr, status, reason)=>{})
    }


    function showDetails(id){
        $("#main").hide();
        $("#detail").show();
        $("#comments").show();
        var url = "https://jsonplaceholder.typicode.com/posts/" + id;
        $.getJSON(url)
            .done((data) => {
                console.log(data);
                var details = '<span>'+'<b>Post ID : </b>'+data.id+'</span><br>'
                    details += '<span>'+ '<b>Title : </b>' + data.title + '</span><br>'
                    details += '<span>' +'<b>Details : </b>'+ data.body + '</span>'
                $("#detail").append(details)
            })
            .fail((xhr, status, error) => {})
        showComments(id)
    }
    loadPosts = () => {
        $("#main").show();
        $("#details").hide();
        $("#comments").hide();

        var url = "https://jsonplaceholder.typicode.com/posts";
        $.getJSON(url)
            .done((data) => {
                $.each(data, (k, item) => {
                    console.log(item);
                    var line = "<tr>";
                    line += "<td>" + item.id + "</td>";
                    line += "<td><b>" + item.title + "</b><br/>";
                    line += item.body + "</td>";
                    line += "<td> <button class='btnLink' onClick='showDetails(" + item.id + ");' > link </button> </td>";

                    line += "</tr>";
                    $("#tblPosts").append(line);
                });
                $("#main").show();
            })
            .fail((xhr, status, error) => {

            })
    }

    $(() => {
        loadPosts();
        $("#btnBack").click(() => {
            $("#main").show();
            $("#comments").hide();
            $("#detail").text('');
            $("#list-comment").text('');
        });
    })
</script>

</html>
