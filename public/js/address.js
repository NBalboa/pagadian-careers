$(document).ready(function () {
    function showAllMunicipalitiesByProvince(data) {
        let municipalities = [];

        $("#provinces").on("change", function () {
            const province = $(this).val();

            for (const key in data) {
                const regions = data[key];

                if (regions.province_list.hasOwnProperty(province)) {
                    const allMunicipality = Object.keys(
                        regions.province_list[province].municipality_list
                    );

                    municipalities = allMunicipality;
                }
            }

            $("#municipalities")
                .empty()
                .append(
                    '<option selected value="">Select a Municipality</option>'
                );

            municipalities.forEach((municipality) => {
                $("#municipalities").append(
                    `<option value="${municipality}">${municipality}</option>`
                );
            });
        });
    }

    function showAllBarangayByMunicipality(data) {
        let barangays = [];

        $("#municipalities").on("change", function () {
            const city = $(this).val();
            for (const key in data) {
                const regions = data[key];
                const provinces = regions.province_list;
                for (const province_key in provinces) {
                    const municipalities =
                        provinces[province_key].municipality_list;
                    if (municipalities.hasOwnProperty(city)) {
                        barangays = municipalities[city].barangay_list;
                    }
                }
            }

            $("#barangays")
                .empty()
                .append('<option selected value="">Select a Barangay</option>');

            barangays.forEach((barangay) => {
                $("#barangays").append(
                    `<option value="${barangay}">${barangay}</option>`
                );
            });
        });
    }

    $.getJSON(
        "https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/3c993f5669bc7ca62d2c5740eb1733923e61eac2/philippine_provinces_cities_municipalities_and_barangays_2019v2.json",
        function (data) {
            // showAllProvinces(data);
            showAllMunicipalitiesByProvince(data);
            showAllBarangayByMunicipality(data);
        }
    );
});
