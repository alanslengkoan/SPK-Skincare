    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Profil</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li class="active">Profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profil</h4>
                        </div>
                        <div class="card-body">
                            <div class="default-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="akun" data-toggle="tab" href="#nav-akun" role="tab" aria-controls="nav-akun" aria-selected="true">Akun</a>
                                        <a class="nav-item nav-link" id="security" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security" aria-selected="false">Security</a>
                                    </div>
                                </nav>
                                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                    <!-- begin:: akun -->
                                    <div class="tab-pane fade show active" id="nav-akun" role="tabpanel" aria-labelledby="akun">
                                        <form action="aksi/?aksi=profil_akun" id="form-akun" method="post">
                                            <input type="hidden" name="id_users_akun" id="id_users_akun" value="<?= $rowLog->id_users ?>">

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama&nbsp;*</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="nama" id="nama" class="form-control form-control-sm" value="<?= $rowLog->nama ?>" />
                                                    <small class="help-block form-text error"></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email&nbsp;*</label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="email" id="email" class="form-control form-control-sm" value="<?= $rowLog->email ?>" />
                                                    <small class="help-block form-text error"></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Username&nbsp;*</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="username" id="username" class="form-control form-control-sm" value="<?= $rowLog->username ?>" />
                                                    <small class="help-block form-text error"></small>
                                                </div>
                                            </div>
                                            <button type="submit" name="btn-akun" id="btn-akun" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Ubah</button>
                                        </form>
                                    </div>
                                    <!-- end:: akun -->
                                    <!-- begin:: security -->
                                    <div class="tab-pane fade" id="nav-security" role="tabpanel" aria-labelledby="security">
                                        <form action="aksi/?aksi=profil_security" id="form-security" method="post">
                                            <input type="hidden" name="id_users_security" id="id_users_security" value="<?= $rowLog->id_users ?>">

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Password Lama&nbsp;*</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password_lama" id="password_lama" class="form-control form-control-sm" placeholder="Masukkan Password Lama" />
                                                    <small class="help-block form-text error"></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Password Baru&nbsp;*</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password_baru" id="password_baru" class="form-control form-control-sm" placeholder="Masukkan Password Baru" />
                                                    <small class="help-block form-text error"></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Ulangi Password Baru&nbsp;*</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password_baru_lagi" id="password_baru_lagi" class="form-control form-control-sm" placeholder="Masukkan kembali password Anda" />
                                                    <small class="help-block form-text error pesan"></small>
                                                </div>
                                            </div>
                                            <button type="submit" name="btn-security" id="btn-security" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Ubah</button>
                                        </form>
                                    </div>
                                    <!-- end:: security -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>