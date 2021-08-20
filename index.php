<?php

require 'vendor/autoload.php';

use App\Connection;

$pdo = (new Connection())->connectSQL();
?>

<!doctype html>
<html lang="sk">

<head>
    <meta http-equiv=“Content-Type“ content=“text/html; charset=utf-8″ />
    <meta http-equiv=“Content-Language“ content=“sk“ />
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <title>Denník N - úloha</title>
</head>

<body class="py-4">

    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Pridať užívateľa</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addSubsModal">Pridať predplatné</button>
                    <div class="table-responsive mt-4">
                        <table id="users-table" class="table text-left">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pridať užívateľa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="alert alert-success" role="alert" style="display: none">
                            Pridanie bolo úspešné
                        </div>
                        <div class="alert alert-danger" role="alert" style="display: none">
                            Pridanie sa nepodarilo
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Heslo</label>
                            <input type="password" class="form-control" id="inputPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="reg-date">Dátum registrácie</label>
                            <input class="form-control datepicker" id="reg-date" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="addUser" class="btn btn-success">Pridať</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSubsModal" tabindex="-1" aria-labelledby="addSubsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pridať predplatné</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="alert alert-success" role="alert" style="display: none">
                            Pridanie bolo úspešné
                        </div>
                        <div class="alert alert-danger" role="alert" style="display: none">
                            Pridanie sa nepodarilo
                        </div>
                        <div class="form-group">
                            <label for="userSelect">Užívateľ</label>
                            <select id="userSelect" class="custom-select">
                                <option selected>Vyberte email</option>
                                <?php
                                $result = $pdo->query("SELECT email, id FROM User");
                                foreach ($result as $user) {
                                    echo "<option value='" . $user['id'] . "'>" . $user['email'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subs-start">Začiatok</label>
                            <input class="form-control datepicker" id="subs-start">
                        </div>
                        <div class="form-group">
                            <label for="subs-end">Koniec</label>
                            <input class="form-control datepicker" id="subs-end">
                        </div>
                        <div class="form-group">
                            <label for="typeSelect">Typ predplatného</label>
                            <select id="typeSelect" class="custom-select">
                                <option selected>Vyberte predplatné</option>
                                <?php
                                $result = $pdo->query("SELECT * FROM Subs_type");
                                foreach ($result as $type) {
                                    echo "<option value='" . $type['id'] . "'>" . $type['type'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="addSubs" class="btn btn-success">Pridať</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.datepicker').each(function() {
            $(this).datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
            })
        });
    </script>

    <script type="module">
        import {
            loadTable
        } from './assets/js/script.js';

        $(window).ready(function() {
            loadTable();
        })
    </script>
    <script type="module" src="assets/js/script.js"></script>
    <script type="module" src="assets/js/addUser.js"></script>
    <script type="module" src="assets/js/addSubs.js"></script>
</body>

</html>