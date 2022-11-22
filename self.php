<div class="container" style="padding-top:50px">
    <div class="row">
        <div
            class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Votre profile</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form id="profile_form" action="updateProfile.php" method="post" enctype="multipart/form-data">
                            <input hidden name="userID" value="<?php echo $user; ?>"/>
                            <div class="col-md-9 col-lg-9 " align="center"><img
                                    id="imagecanvas"
                                    alt="User Pic"
                                    src="<?php echo $data['profile_picture']; ?>"
                                    class="img-circle img-responsive"
                                    style="max-width:30%;max-height:30%;">
                                <p>
                                    <label for="file">Choisir un fichier:</label> <input type="file" disabled name="userfile"
                                                                                    id="file"
                                                                                    onchange="readURL(this);"
                                    > <br/>
                            </div>
                            <?php
                            if (isset($_POST['userfile'])) {


                                $target_dir = "./uploads/profile";
                                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                                echo $target_file;
                                $uploadOk = 1;
                                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                                // Check if image file is a actual image or fake image
                                if (isset($_POST["envoyer"])) {
                                    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                                    if ($check !== false) {
                                        echo "fichier image - " . $check["mime"] . ".";
                                        $uploadOk = 1;
                                    } else {
                                        echo "Le fichier n'est pas une image.";
                                        $uploadOk = 0;
                                    }
                                }
                                // Check file size
                                if ($_FILES["fileToUpload"]["size"] > 500000) {
                                    echo "Fichier trop gros.";
                                    $uploadOk = 0;
                                }
                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                    && $imageFileType != "gif"
                                ) {
                                    echo "Désolé, sont accéptés seulement les fichiers JPG, JPEG, PNG & GIF.";
                                    $uploadOk = 0;
                                }
                                // Check if $uploadOk is set to 0 by an error
                                if ($uploadOk == 0) {
                                    echo "Erreur, veuillez ré-éssayer.";
                                // if everything is ok, try to upload file
                                } else {
                                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                                        echo "Le fichier " . basename($_FILES["userfile"]["name"]) . " a bien été uploadé.";
                                    } else {
                                        echo "Erreur, veuillez ré-éssayer.";
                                    }
                                }
                            }
                            ?>
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Nom d'utilisateur</td>
                                        <td><input type="text" disabled name="username"
                                                   value= <?php echo $data['username']; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prénom</td>
                                        <td><input type="text" disabled name="firstName"
                                                   value= <?php echo $data['first_name']; ?>></td>
                                    </tr>
                                    <tr>
                                        <td>Nom</td>
                                        <td><input type="text" disabled name="lastName"
                                                   value= <?php echo $data['last_name']; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date de naissance</td>
                                        <td><input type="text" disabled name="dob"
                                                   value= <?php echo $data['birthdate']; ?>>
                                        </td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><input type="text" disabled name="email"
                                                   value= <?php echo $data['email']; ?>>
                                        </td>
                                    </tr>
                                    <!--                                    Conditional label based on who you are -->
                                    <?php
                                    if ($data['role_id'] == 2) {
                                        echo "<td>Note de vendeur</td>";
                                    } else {
                                        echo "<td>Note d'acheteur</td>";
                                    }
                                    ?>
                                    <td>
                                        <?php
                                        $stars = round($data['rating'], 0, PHP_ROUND_HALF_DOWN);
                                        $diff = $data['rating'] - $stars;
                                        $perc = number_format(($data['rating'] / 5) * 100);
                                        do {
                                            if ($stars == 1 && $diff < 0) {
                                                echo '<span class="glyphicon glyphicon-star opacity"></span>';
                                            } else {
                                                echo '<span class="glyphicon glyphicon-star"></span>';
                                            }
                                            $stars = $stars - 1;
                                        } while ($stars > 0);
                                        echo "<p>  " . $perc . "% </p>";
                                        ?>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <input class="btn btn-sm btn-warning" id="edit" type="button" value="Editer">
                                <input class="btn btn-sm btn-success" disabled type="submit" value="Envoyer">
                                </a>
                            </div>
                        </form>
                        <!--                                Need to get this to work and only available when in edit mode-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    var el = document.getElementById('edit');
    var frm = document.getElementById('profile_form');
    el.addEventListener('click', function () {
        for (var i = 0; i < frm.length; i++) {
            frm.elements[i].disabled = false;

        }
        frm.elements[0].focus();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagecanvas')
                    .attr('src', e.target.result)
//                    .width(150)
//                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>