<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="erfan ebrahimi">

    <title>دفترچه تلفن</title>

    <link href="{$templateDir}/css/toolkit-inverse.css" rel="stylesheet">
    <link rel="stylesheet" href="{$templateDir}/css/font-awesome.min.css">


    <link href="{$templateDir}/css/application.css" rel="stylesheet">

</head>


<body>
<div class="bw">
    <div class="dh">
        <div class="en bpz">
            <nav class="bqg">
                <div class="bqa">
                    <button class="bow boy bqb" type="button" data-toggle="collapse" data-target="#nav-toggleable-md">
                        <span class="adp">Toggle nav</span>
                    </button>
                    <a class="bqc brd" href="#">
                        <span class="bv bhc bqd"></span>
                    </a>
                </div>

                <div class="collapse bpd" id="nav-toggleable-md">
                    <form class="bqe" method="get" action="{$siteUrl}home/search">
                        <input class="form-control" name="search" type="text" autofocus autocomplete="off" placeholder="Search...">
                        <button type="submit" class="nz">
                            <span class="bv bhw"></span>
                        </button>
                    </form>
                    <div class="nav pb nav-stacked wz contactEditOrAdd">
                        <div class="avatar ce">
                            <img src="https://www.gravatar.com/avatar/d06e664c1ea597ce6388ed773fa26d34/?s=100&d=mp" class="contactAvatar hidden" alt="avatar" >
                        </div>
                        <form action="{$siteUrl}home/edit" method="post">
                            <input type="hidden" name="id" class="contactId" value="0">
                            first name :
                            <input type="text" value="" autocomplete="off" name="firstName" class="form-control contactFirstName">
                            last name :
                            <input type="text" value="" autocomplete="off" name="lastName" class="form-control contactLastName">
                            phone :
                            <input type="text" value="" autocomplete="off" name="phone" class="form-control contactPhone">
                            email :
                            <input type="email" value="" autocomplete="off" name="email" class="form-control contactEmail">
                            <input type="submit" value="save" class="btn btn-success">
                        </form>
                    </div>
                    <hr class="bre aez">
                </div>
            </nav>
        </div>
        <div class="et brf">
            <div class="bqn">
                <div class="bqo">
                    <h6 class="bqq">phone book</h6>
                    <h2 class="bqp">Contacts</h2>
                </div>

                <div class="on bqr">
                    <div class="ol">
                        <button type="button" class="ce nr" onclick="showContactForEdit(0,'','','','','')">
                            <i class="fa fa-plus"></i> Add New Contact
                        </button>
                        <button type="button" class="ce nr" onclick="$('#deleteContact').submit();">
                            <i class="fa fa-trash"></i>Delete Selected Contacts
                        </button>
                    </div>
                </div>
            </div>


            <div class="ly">
                <form action="{$siteUrl}home/delete" method="post" id="deleteContact">
                <table class="ck" >
                    <thead>
                    <tr>
                        <th><input type="checkbox" class="bsn" onclick="$('.bso').prop('checked', $(this).prop('checked'));" id="selectAll"></th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>phone</th>
                        <th>email</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$listContent key=key item=item }
                        <tr class="selectConatct" onclick="showContactForEdit({$item.id},'{$item.firstName}','{$item.lastName}','{$item.phone}','{$item.email}' , '{$item.email|md5}')">
                            <td><input type="checkbox" value="{$item.id}" name="deleted[]" class="bso"></td>
                            <td class="contactInfo" >{$item.firstName}</td>
                            <td class="contactInfo">{$item.lastName}</td>
                            <td class="contactInfo">{$item.phone}</td>
                            <td class="contactInfo">{$item.email}</td>
                        </tr>
                        {foreachelse}
                        <tr>
                            <td class="contactInfo"  colspan="5" style="text-align: center;" >no record find</td>
                        </tr>
                    {/foreach}

                    </tbody>
                </table>
                </form>
            </div>

            <!--<div class="avv">
                <nav>
                    <ul class="qn">
                        <li class="qp">
                            <a class="qo" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="adp">Previous</span>
                            </a>
                        </li>
                        <li class="qp active"><a class="qo" href="#">1</a></li>
                        <li class="qp"><a class="qo" href="#">2</a></li>
                        <li class="qp"><a class="qo" href="#">3</a></li>
                        <li class="qp"><a class="qo" href="#">4</a></li>
                        <li class="qp"><a class="qo" href="#">5</a></li>
                        <li class="qp">
                            <a class="qo" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="adp">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>-->

        </div>
    </div>
</div>



<script src="{$templateDir}/js/jquery.min.js"></script>
<script src="{$templateDir}/js/popper.min.js"></script>
<script src="{$templateDir}/js/chart.js"></script>
<script src="{$templateDir}/js/tablesorter.min.js"></script>
<script src="{$templateDir}/js/toolkit.js"></script>
<script src="{$templateDir}/js/application.js"></script>
<script>
    // execute/clear BS loaders for docs
    $(function(){ while(window.BS&&window.BS.loader&&window.BS.loader.length){ (window.BS.loader.pop())()}})

    function showContactForEdit(id,firstname,lastname,phone,email,emailMd5) {
        $(".contactId").val(id);
        $(".contactFirstName").val(firstname);
        $(".contactLastName").val(lastname);
        $(".contactPhone").val(phone);
        $(".contactEmail").val(email);
        if ( email !== '' )
            $(".contactAvatar").attr("src",'https://www.gravatar.com/avatar/'+emailMd5+'/?s=100&d=mp').removeClass('hidden');
        else
            $(".contactAvatar").addClass('hidden');
    }
</script>
</body>

</html>

