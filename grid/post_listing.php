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

    @media (min-width: 34em) {
        .card-columns {
            -webkit-column-count:1;
            -moz-column-count:1;
            column-count:1;
        }
    }

    @media (min-width: 48em) {
        .card-columns {
            -webkit-column-count:2;
            -moz-column-count:2;
            column-count:2;
        }
    }

    @media (min-width: 62em) {
        .card-columns {
            -webkit-column-count:3;
            -moz-column-count:3;
            column-count:3;
        }
    }

    @media (min-width: 75em) {
        .card-columns {
            -webkit-column-count:".$param['per_ligne'].";
            -moz-column-count:".$param['per_ligne'].";
            column-count:".$param['per_ligne'].";
        }
    }

    </style>
    ";

    echo "
    <div id='postList' 
    apiUrl_fr='".$param['site_url_fr']."' 
    apiUrl_en='".$param['site_url_en']."' 
    totalPost='".$param['total_post']."'
    perLigne='".$param['per_ligne']."'
    language='".get_bloginfo("language")."'
    > 

    <div>
     <div class='card-columns' id='row-grid'>
       <div style='text-align:center'>Chargement...</div>
     </div>
    </div>
    
    </div>
";
;?>
<script type="text/javascript">
$(function(){
    var api_url_en=$("#postList").attr("apiUrl_en");
    var api_url_fr=$("#postList").attr("apiUrl_fr");
    var total_post=$("#postList").attr("totalPost");
    var language=$("#postList").attr("language");
    var calendar_en=["Jan", "Feb", "Mar","Apr", "May", "June","July","Aug", "Sep","Oct", "Nov", "Dec"];
    var calendar_fr=["Jan", "Fev", "Mar","Avr", "Mai", "Juin","Jui","Août", "Sep","Oct", "Nov", "Dec"];
    var posts=[];

    if(language=="en-US"){
        var api_url=api_url_en;
        var calendar=calendar_en;
        var dateText="Published date";
        var authorText="Author";
        var buttonText="Read more";
    }
    else
    {
        var api_url=api_url_fr;
        var calendar=calendar_fr;
        var dateText="Date de publication";
        var authorText="Auteur";
        var buttonText="Lire la suite";
    }
    console.debug(api_url,language);

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

    function convertDate(mydate){
        var _date = new Date(mydate);
        var day = _date.getDate();
        var month = _date.getMonth();
        var year = _date.getFullYear();
        return `${day} ${calendar[month-1]} ${year}`;
    }

    // List Post
    function listPost(data){
        var postGrid=$("#row-grid");
        var htmlContent="";
        
        data.map((item, key)=>{
            
            //date 
            var _date=convertDate(item["date"]);
            var _img=item["_embedded"]["wp:featuredmedia"][0]["media_details"]["sizes"]["large"]["source_url"];
            htmlContent+=`
            <div class="card post-bg-color my-2" style="border:none;border-radius: 0rem !important;">
                <a href="${item.link}"><img id="post-img" class="post-img-height post-img-width" src="${_img}" alt="Card image cap"></a>

                <div class="card-body">
                <h5 class="card-title post-title-font post-title-color">
                ${item.title.rendered}
                </h5>
                
                <p class="my-2 post-meta-font post-meta-color"> 
                ${dateText}: <span> ${_date} </span> <br/>
                ${authorText}: <span> ${item["acf"]['auteur']} </span> 
                </p>

                <div class="my-1">
                <p class="post-description-font post-description-color">
                ${item["acf"]['chapeau']}</p> 
                </div>

                <div class="my-1"> <a href="${item.link}" target="_blank" class="post_link post-button-font post-button-bg-color post-button-color">  ${buttonText} </a> </div>

                </div>
            </div>
            `;


        })

        postGrid.html(htmlContent);
        console.log("List Post");
    }

    getPost(api_url);
    

});
</script>
<?php
}