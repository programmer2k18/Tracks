$(document).ready(function(){

    $.ajax({
        url: "https://api.jsonbin.io/b/5f69e387302a837e956b59b5",
        type:"get",
        success: function(result) {

            for (let i=0; i<result.tracks.length;i++){
                addNewElement(result.tracks[i]);
            }

        },
        error:function (error) {
            alert('SomeThing went wrong, Please try again or later...')
        }
    });

    function addNewElement(track) {

        let download = '';
        if ($('#indicator').data('check')){
            download="<a href='src/Auth/Login.php?url="+track.url+"' class='btn btn-primary'>Download</a>\n";

        } else{
            download="<a href='src/Auth/Login.php?url="+track.url+"' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal' data-whatever='@mdo'>Download</a>\n";
        }

        let element = "<div class='col-sm-6' style='margin-bottom: 10px'>\n" +
            "                    <div class='card'>\n" +
            "                        <div class='card-body'>\n" +
            "                            <h5 class='card-title'>"+track.name+"</h5>\n" +
            "                            <p class='card-text'>Artist: "+track.artist+"</p>\n" +
            "                            <p class='card-text'>Length: "+track.length+"</p>\n" +
            download +
            "                        </div>\n" +
            "                    </div>\n" +
            "          </div>";


        $(element).appendTo("#tracks");

    }

});
