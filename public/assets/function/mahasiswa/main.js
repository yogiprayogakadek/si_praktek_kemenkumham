function getData(divisi = 'semua') {
    $.ajax({
        type: "get",
        url: "/mahasiswa/render/"+divisi,
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    $('body').on('click', '.btn-edit', function () {
        let uuid = $(this).data('uuid')
        $.ajax({
            type: "get",
            url: "/mahasiswa/edit/" + uuid,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // validasi
    $('body').on('click', '.btn-validasi', function() {
        var uuid = $(this).data('uuid');
        Swal.fire({
            title: 'Anda yakin?',
            text: "Ubah status data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, validasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/mahasiswa/validate/' + uuid,
                    type: 'GET',
                    success: function (result) {
                        Swal.fire(
                            result.title,
                            result.message,
                            result.status
                        )
                        getData();
                    }
                });
            }
        })
    });

    $('body').on('change', '.divisi', function() {
        let uuid = $('select[name="divisi"] option').filter(':selected').val();

        uuid == '' ? getData('semua') : getData(uuid);
    })
});