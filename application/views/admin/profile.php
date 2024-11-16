<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Profile</h3>
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit">Edit Profile</button>
</div>

<?= $this->session->flashdata('pesan'); ?>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-lg mb-0">
                            <tbody>
                                <tr>
                                    <th class="text-capitalize" width="20%">nama lengkap</th>
                                    <td>: <?= ucwords($user['nama_lengkap']); ?></td>
                                </tr>
                                <tr>
                                    <th class="text-capitalize" width="20%">username</th>
                                    <td>: <?= $user['username']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-capitalize" width="20%">no. telp</th>
                                    <td>: <?= $user['no_telp']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL EDIT DATA -->
<div class="modal fade text-left modal-borderless" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <?= form_open('edit_profile/' . $user['id_user']) ?>
            <?= form_hidden('id_user', $user['id_user']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="nama_lengkap">Nama Lengkap: </label>
                        <div class="form-group">
                            <input id="nama_lengkap" name="nama_lengkap" type="text" placeholder="Masukkan Nama Lengkap" class="form-control" value="<?= ucwords($user['nama_lengkap']); ?>" oninvalid="this.setCustomValidity('Masukkan Nama Lengkap')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="no_telp">No. Telp: </label>
                        <div class="form-group">
                            <input id="no_telp" name="no_telp" type="tel" placeholder="Masukkan No. Telp" class="form-control" value="<?= $user['no_telp']; ?>" oninvalid="this.setCustomValidity('Masukkan No. Telp')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="username">Username: </label>
                        <div class="form-group">
                            <input id="username" name="username" type="text" placeholder="Masukkan username" value="<?= $user['username']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="password">Password: </label>
                        <div class="form-group">
                            <input id="password" name="password" type="password" placeholder="Masukkan Password Baru" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Keluar</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Edit</span>
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>