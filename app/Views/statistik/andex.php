<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row  ">
        <div class="inputan col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($user as $r) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $r['nama'] ?></td>
                        <td><?= $r['nilai']; ?></td>
                        <td>
                            <form action="/statistik/<?= $r['id']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')"> Hapus</button>
                                <input type="hidden" name="_method" value="delete">
                            </form>
                            <a href="/statistik/edit/<?= $r['id']; ?>" class="btn btn-warning ">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class=" inputan col-md-4">
            <table class="table">
                <form action="/statistik/save" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input for="nama" type="text"
                            class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama"
                            name="nama" placeholder="Nama" autofocus value="<?= old('nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input for="nilai" type="number"
                            class="form-control <?= ($validation->hasError('nilai')) ? 'is-invalid' : ''; ?>" id="nilai"
                            name="nilai" placeholder="Masukan nilai" value="<?= old('nilai'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('nilai'); ?>
                        </div>
                    </div>
        </div>

        <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    </div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary btn-success">Input</button>
    </form>
    </table>
</div>

</div>

</div>

<!-- <div class="container">
    <div class="row">
        <div class="inputan col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nilai maximum</th>
                        <th scope="col">Nilai minimum</th>
                        <th scope="col">Rata - rata</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Data</th>
                        <td> Data </td>
                        <td> Data </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="inputan col-md-6 ">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nilai</th>
                        <th scope="col">Frekuensi</th>
                        <th scope="col">Total Nilai</th>
                        <th scope="col">Total Frekuensi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> Data</td>
                        <td> Data </td>
                        <td> Data</td>
                        <td> Data </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div> -->



<?= $this->endSection(); ?>