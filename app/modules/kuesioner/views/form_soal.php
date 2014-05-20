
<form id="tambahSoal" action="<?= base_url('index.php/kuesioner/soal/proses/'); ?>" method="post"  name="newproject" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Kode</td>
            <td>Kode</td>
        </tr>
        <tr>
            <td><label for="soal">Soal</label></td>
            <td><input type="text" name="soal" value="" id="soal" tabindex="1" placeholder="Soal" /></td>
        </tr>
        <tr>
            <td><label for="status">Status</label></td>
            <td><input type="text" name="status" value="" id="status" tabindex="1" placeholder="status" /></td>
        </tr>
        <tr>
            <td>
                <button class="btn btn-small" onclick="save()" value="submit">Simpan</button>
            </td>

            <td> | <a href="<?= base_url('index.php/kuesioner/soal/'); ?>"> cancel</a></td>
        </tr>
    </table>
</form>

<script>
                    $(document).ready(function() {
                        $("#tambahSoal").validationEngine();
                    });

                    function save()
                    {
                        var validate = $('$tambahSoal').validateEngine("validate");
                        if (!validate) {
                            return false;
                        }

                        var submit = $('#tambahSoal').serialize();
                        $.ajax({
                        });
                    }
</script>