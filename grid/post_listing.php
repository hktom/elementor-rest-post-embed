<?php

function postListapi($param){
    
    echo "
    <style>

    #post-img{
        object-fit:".$param['object_fit'].";
        object-position:".$param['object_fit_position']."
    }

    .post_link{
        text-decoration:none;
    }
    .post_link:hover{
        text-decoration:none;
    }

    </style>
    ";

    echo "
    <div id='postList' 
    apiUrl='".$param['site_url']."' 
    totalPost='".$param['total_post']."'
    perLigne='".$param['per_ligne']."'
    > 

    <div class='column'>
     <div class='row' id='row-grid'>
       <div style='text-align:center'>Chargement...</div>
     </div>
    </div>
    
    </div>
";
;?>
<script type="text/javascript">
$(function(){
    var api_url=$("#postList").attr("apiUrl");
    var total_post=$("#postList").attr("totalPost");
    var per_ligne=$("#postList").attr("perLigne");
    var rowStyle="";
    var posts=[];

    switch (per_ligne) {
        case '1':
        rowStyle="col-lg-12 col-md-12 col-sm-12";
        break;
        case '2':
        rowStyle="col-lg-6 col-md-6 col-sm-12";
        break;
        case '3':
        rowStyle="col-lg-4 col-md-6 col-sm-12";
        break;
        case '4':
        rowStyle="col-lg-3 col-md-6 col-sm-12";
        break;
        default:
        rowStyle="col-lg-4 col-md-6 col-sm-12";
        break;
    }

    // get posts from url
    function getPost(url){
        axios.get(`${url}&per_page=${total_post}`)
        .then(function (response) {
            // handle success
            posts=response;
            listPost(posts.data);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    }

    // List Post
    function listPost(data){
        var postGrid=$("#row-grid");
        var htmlContent="";
        
        data.map((item, key)=>{
        
            // open Tag
            htmlContent+=`<div class='${rowStyle} px-2'>`;
            htmlContent+="<div class='post-bg-color'>";
            // img
            htmlContent+=`<div class="my-1">
            <img id="post-img" class="post-img-height post-img-width" src="${item["_embedded"]["wp:featuredmedia"][0]["media_details"]["sizes"]["large"]["source_url"]}"/>
            </div>`;
            htmlContent+="<div class='px-4 py-4'>";
            // title 
            htmlContent+=`<div class="my-4"> <h3 class="post-title-font post-title-color"> ${item.title.rendered} </h3></div>`;
            //date de publication
            htmlContent+=`<div class="my-2 post-meta-font post-meta-color"> Date de publication: <span> ${item["date"]} </span> </div>`;
            //cours auteur
            htmlContent+=`<div class="my-2 post-meta-font post-meta-color"> Auteur: <span> ${item["acf"]['auteur']} </span> </div>`;

            //description
            htmlContent+=`<div class="my-1"><p class="post-description-font post-description-color">${item["acf"]['chapeau']}</p> </div>`;

            //lien
            htmlContent+=`<div class="my-1"> <a href="${item.link}" target="_blank" class="post_link post-button-font post-button-bg-color post-button-color"> 
            Lire la suite</a> </div>`;

            htmlContent+="</div>";

            htmlContent+="</div>";
            // end tag
            htmlContent+="</div>";
        })

        postGrid.html(htmlContent);
        console.log("List Post");
    }

    getPost(api_url);
    

});
</script>
<?php
}