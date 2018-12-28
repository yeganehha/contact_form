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
                    <form class="bqe" method="post" action="{$siteUrl}search">
                        <input class="form-control" name="search" type="text" placeholder="Search...">
                        <button type="submit" class="nz">
                            <span class="bv bhw"></span>
                        </button>
                    </form>
                    <div class="nav pb nav-stacked wz contactEditOrAdd">
                        <div class="avatar ce">
                            <img src="https://www.gravatar.com/avatar/d06e664c1ea597ce6388ed773fa26d34/?s=100&d=mp" alt="avatar" >
                        </div>
                        <form action="{$siteUrl}home/edit" method="post">
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
                        <button type="button" class="ce nr">
                            <i class="fa fa-plus"></i> Add New Contact
                        </button>
                        <button type="button" class="ce nr">
                            <i class="fa fa-trash"></i>Delete Selected Contacts
                        </button>
                    </div>
                </div>
            </div>


            <div class="ly">
                <table class="ck" >
                    <thead>
                    <tr>
                        <th><input type="checkbox" class="bsn" id="selectAll"></th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>phone</th>
                        <th>email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="selectConatct">
                        <td><input type="checkbox" value="12" name="deleted[]" class="bso"></td>
                        <td class="contactInfo" >erfan</td>
                        <td class="contactInfo">ebrahimi</td>
                        <td class="contactInfo">09361090413</td>
                        <td class="contactInfo">persionhost@gmail.com</td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="avv">
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
            </div>

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
</script>
</body>

</html>

