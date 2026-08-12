<div
    class="modal fade"
    id="detailModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    AI Detection Detail

                </h5>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="card border-0 shadow-sm">

                            <div class="card-header">

                                Original Image

                            </div>

                            <div class="card-body text-center">

                                <img
                                    id="originalImage"
                                    class="img-fluid rounded">

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="card border-0 shadow-sm">

                            <div class="card-header">

                                AI Detection Result

                            </div>

                            <div class="card-body text-center">

                                <img
                                    id="detectedImage"
                                    class="img-fluid rounded">

                            </div>

                        </div>

                    </div>

                </div>

                <hr>

                <div class="row mt-4">

                    <div class="col-md-6">

                        <table class="table">

                            <tr>

                                <th>Detection ID</th>

                                <td id="detectionId"></td>

                            </tr>

                            <tr>

                                <th>Confidence</th>

                                <td id="confidence"></td>

                            </tr>

                            <tr>

                                <th>Status</th>

                                <td id="status"></td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table class="table">

                            <tr>

                                <th>Bottle</th>

                                <td id="bottle"></td>

                            </tr>

                            <tr>

                                <th>Cap</th>

                                <td id="cap"></td>

                            </tr>

                            <tr>

                                <th>Label</th>

                                <td id="label"></td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>