<main id="main-container">
    <div class="content">
        <form action="">
            <div>
                <div class="text-center">
                    <h4>Cálculo de Error (ACE)</h4>
                </div>
                <div class="mb-3">
                    <h6>REspuesta de Calibración del Analizador (Cdir)</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                O<sub>2</sub>%
                            </div>
                            <div class="mb-3">
                                <input type="number" name="CalculoErrorO2Txt1" id="CalculoErrorO2Txt1" step="0.01" class="form-control">
                            </div>
                            <div class="mb-3">
                                <br>
                                <input type="number" name="CalculoErrorO2Txt2" id="CalculoErrorO2Txt2" step="0.01" class="form-control">
                            </div>
                            <div class="mb-3">
                                <br>
                                <input type="number" name="CalculoErrorO2Txt3" id="CalculoErrorO2Txt3" step="0.01" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                CO ppmv
                            </div>
                            <div class="mb-3">
                                <input type="number" name="CalculoErrorCOTxt1" id="CalculoErrorCOTxt1" step="0.01" class="form-control">
                            </div>
                            <div class="mb-3">
                                <br>
                                <input type="number" name="CalculoErrorCOTxt2" id="CalculoErrorCOTxt2" step="0.01" class="form-control">
                            </div>
                            <div class="mb-3">
                                <br>
                                <input type="number" name="CalculoErrorCOTxt3" id="CalculoErrorCOTxt3" step="0.01" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                NOx ppmv
                            </div>
                            <div class="mb-3">
                                <input type="number" name="CalculoErrorNoxTxt1" id="CalculoErrorNoxTxt1" step="0.01" class="form-control">
                            </div>
                            <div class="mb-3">
                                <br>
                                <input type="number" name="CalculoErrorNoxTxt2" id="CalculoErrorNoxTxt2" step="0.01" class="form-control">
                            </div>
                            <div class="mb-3">
                                <br>
                                <input type="number" name="CalculoErrorNoxTxt3" id="CalculoErrorNoxTxt3" step="0.01" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>

            <div>
                <div class="text-center">
                    <h4>Cálculo del Bias, Drift y medición del tiempo de respuesta y flujo para el NOx</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NOx (Cdir)</th>
                                <th>Respuesta Sistema</th>
                                <th>Tr(s)</th>
                                <th>Flujo L/min</th>
                                <th>Respuesta Sistema</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span>BAJA ppmv</span>
                                    <input type="number" name="CalculoNoxCdir1" id="CalculoNoxCdir1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxRs1_1" id="CalculoNoxRs1_1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxTrs1" id="CalculoNoxTrs1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxFlujo1" id="CalculoNoxFlujo1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxRs2_1" id="CalculoNoxRs2_1" step="0.01" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Media/Alta</span>
                                    <input type="number" name="CalculoNoxCdir2" id="CalculoNoxCdir2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxRs1_2" id="CalculoNoxRs1_2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxTrs1" id="CalculoNoxTrs1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxFlujo2" id="CalculoNoxFlujo2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoNoxRs2_2" id="CalculoNoxRs2_2" step="0.01" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br><br>

            <div>
                <div class="text-center">
                    <h4>Cálculo del Bias, Drift y medición del tiempo de respuesta y flujo para el CO</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NOx (Cdir)</th>
                                <th>Respuesta Sistema</th>
                                <th>Tr(s)</th>
                                <th>Flujo L/min</th>
                                <th>Respuesta Sistema</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span>BAJA ppmv</span>
                                    <input type="number" name="CalculoCoCdir1" id="CalculoCoCdir1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoRs1_1" id="CalculoCoRs1_1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoTrs1" id="CalculoCoTrs1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoFlujo1" id="CalculoCoFlujo1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoRs2_1" id="CalculoCoRs2_1" step="0.01" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Media/Alta</span>
                                    <input type="number" name="CalculoCoCdir2" id="CalculoCoCdir2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoRs1_2" id="CalculoCoRs1_2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoTrs1" id="CalculoCoTrs1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoFlujo2" id="CalculoCoFlujo2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoCoRs2_2" id="CalculoCoRs2_2" step="0.01" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br><br>

            <div>
                <div class="text-center">
                    <h4>Cálculo del Bias, Drift y medición del tiempo de respuesta y flujo para el O2</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NOx (Cdir)</th>
                                <th>Respuesta Sistema</th>
                                <th>Tr(s)</th>
                                <th>Flujo L/min</th>
                                <th>Respuesta Sistema</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span>BAJA ppmv</span>
                                    <input type="number" name="CalculoO2Cdir1" id="CalculoO2Cdir1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Rs1_1" id="CalculoO2Rs1_1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Trs1" id="CalculoO2Trs1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Flujo1" id="CalculoO2Flujo1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Rs2_1" id="CalculoO2Rs2_1" step="0.01" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Media/Alta</span>
                                    <input type="number" name="CalculoO2Cdir2" id="CalculoO2Cdir2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Rs1_2" id="CalculoO2Rs1_2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Trs1" id="CalculoO2Trs1" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Flujo2" id="CalculoO2Flujo2" step="0.01" class="form-control">
                                </td>
                                <td>
                                    <br>
                                    <input type="number" name="CalculoO2Rs2_2" id="CalculoO2Rs2_2" step="0.01" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <input type="submit" value="Registrar" class="btn btn-primary">
            </div>
        </form>
    </div>
</main>