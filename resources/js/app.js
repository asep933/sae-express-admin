import $ from "jquery";
window.jQuery = $;
window.$ = $;

import "@fortawesome/fontawesome-free/css/all.css";
import "bootstrap";

import DataTable from "datatables.net-bs4";
import "datatables.net-bs4/css/dataTables.bootstrap4.min.css";
import "datatables.net-responsive-bs4";
import "datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css";
import "datatables.net-staterestore-bs4";

import "./adminlte3";
import "./bootstrap";

$(document).ready(function () {
    /**@type {HTMLAnchorElement} */
    const logoutAnchor = document.querySelector("#logout-button");
    if (logoutAnchor) {
        logoutAnchor.addEventListener("click", function (e) {
            e.preventDefault();

            /**@type {HTMLFormElement} */
            let logoutForm = document.querySelector("#logout-form");
            logoutForm.submit();
        });
    }

    /**@type {HTMLTableElement} */
    let defaultDataTables = document.querySelector("#datatables");
    if (defaultDataTables) {
        /**@type {string | undefined} */
        let datatablesSource = defaultDataTables.dataset.route;
        let tableConfigs = defaultDataTables.dataset.configs;

        const reloadDeleteModal = () => {
            const deleteButtons =
                document.querySelectorAll("button.delete-btn");

            deleteButtons.forEach((deleteButton) => {
                $(defaultDataTables).on(
                    "click",
                    ".container-delete-btn",
                    function (e) {
                        const destroyUrl =
                            deleteButton.getAttribute("data-destroy");
                        const deleteForm =
                            document.querySelector("div#delete-form");
                        const csrfToken = document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content");

                        let form = `
                    <form action="${destroyUrl}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="${csrfToken}" autocomplete="off">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Data</h4>
                            <button type="button" class="close dismiss-modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Delete this data? This process can not be undone.</div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default dismiss-modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                    `;

                        deleteForm.innerHTML = form;

                        $("div#delete-modal").modal({
                            show: true,
                            focus: true,
                            keyboard: false,
                            backdrop: "static",
                        });

                        document
                            .querySelectorAll(".dismiss-modal")
                            .forEach((element) => {
                                element.addEventListener("click", () => {
                                    $("div#delete-modal").modal("hide");
                                });
                            });
                    }
                );
            });
        };

        new DataTable("#datatables", {
            serverSide: true,
            processing: true,
            responsive: true,
            keys: true,
            stateSave: true,
            autoWidth: false,
            info: true,
            ajax: datatablesSource,
            columns: JSON.parse(tableConfigs),
            // initComplete: function (settings, json) {
            //     // Add select filter for created_at
            //     $("#dataTable_length").append("<label>&nbsp; Filter:</label>");
            //     $("#dataTable_length").append(
            //         '<select class="form-control input-sm" id="created_at_filter"></select>'
            //     );

            //     // Populate filter with options
            //     let createdAtFilter = [
            //         { value: "", text: "All Dates" },
            //         { value: "2023-01-01", text: "2023-01-01" },
            //         { value: "2023-01-02", text: "2023-01-02" }, // Add dynamic dates based on available data
            //     ];

            //     for (var i = 0; i < createdAtFilter.length; i++) {
            //         $("#created_at_filter").append(
            //             '<option value="' +
            //                 createdAtFilter[i].value +
            //                 '">' +
            //                 createdAtFilter[i].text +
            //                 "</option>"
            //         );
            //     }

            //     // Filter results on select change
            //     $("#created_at_filter").on("change", function () {
            //         oTable.columns(3).search($(this).val()).draw(); // Assuming `created_at` is column index 3
            //     });

            //     // Add custom styling for select input
            //     $("#created_at_filter").css("width", "auto"); // Optional: adjust width if necessary
            // },
            // initComplete: function (settings, json) {
            //     // Filter results on select change
            //     $("#filter-created-at").on("change", function () {
            //         oTable.columns(3).search($(this).val()).draw(); // Assuming `created_at` is column index 3
            //     });
            // },
            drawCallback: function () {
                reloadDeleteModal();
            },
        });
    }
});

// Fungsi untuk menghitung volumetric weight
function calculateVolumetric() {
    const height = parseFloat(document.getElementById("height").value) || 0;
    const width = parseFloat(document.getElementById("width").value) || 0;
    const length = parseFloat(document.getElementById("length").value) || 0;
    const actualWeight =
        parseFloat(document.getElementById("weight").value) || 0;

    const volumetric = (height * width * length) / 5000;

    const chargeableWeight = Math.max(volumetric, actualWeight);

    document.getElementById("volumetric").value = volumetric.toFixed(2);
    document.getElementById("chargeable_weight").value =
        chargeableWeight.toFixed(2);
}

document.querySelectorAll(".dimension, #weight").forEach((input) => {
    input.addEventListener("input", calculateVolumetric);
});
