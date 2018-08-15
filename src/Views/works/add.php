<div class="container">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#startdate").datetimepicker({
                format: 'yyyy-mm-dd HH:ii'

            });
            $("#enddate").datetimepicker({
                format: 'yyyy-mm-dd HH:ii'

            });
        });
    </script>
    <div>
        <h3>Add a work</h3>
        <?php if (isset($message)) {
                echo "<p style='color : red'> $message</p>";
        } ?>
        <form action="<?php echo URL; ?>works/add" method="POST">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="work_name" class="control-label">Work Name</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input autofocus type="text" name="work_name" value="" required/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="startdate" class="control-label">StartDate</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group date" id="startdate">
                                <input type="text" name="start_date" class="form-control"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="enddate">EndDate</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group date" id="enddate">
                                <input type="text" name="end_date" class="form-control"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="status" class="control-label">Status</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <select name="id_status" required>
                                    <?php foreach ($listStatus as $status) { ?>
                                        <option value="<?php if (isset($status->id)) echo htmlspecialchars($status->id, ENT_QUOTES, 'UTF-8'); ?>">
                                            <?php if (isset($status->status_name)) echo htmlspecialchars($status->status_name, ENT_QUOTES, 'UTF-8'); ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="submit" name="submit_add_work" value="Add Work"/>
        </form>
    </div>
</div>

