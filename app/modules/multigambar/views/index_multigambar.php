        <div id="container">
               <div id="body">
                <div align="left" id="wrapper">

                    <form action="<?php echo site_url('multigambar/upload'); ?>" method="post" enctype="multipart/form-data" id="form-upload">

                        <table>
                            
                            <tbody id="fill">
                                <tr>
                                    <td><label>Select Your Foto</label> <input name="image[]" type="file"  size="20" multiple /></td>
                                </tr>
                            </tbody>
                            <tr>
                                <br />
                                <td><input type="submit" id="submit-button" value="Upload" /></td>
                            </tr>
                        </table>
                    </form>
                    <div id="output"></div>
                </div>
            </div>
        </div>
