<div id="content_main" class="clearfix">
    <div id="main_panel_container" class="left">
        <div id="dashboard">
            <h2 class="ico_mug">Dashboard</h2>
            <div class="clearfix">
                <div class="left quickview">
                    <h3>Overview</h3>
                    <ul>
                        <li>Total Posts: <span class="number">15</span></li>
                        <li>Total Comments: <span class="number">340</span></li>
                        <li>Drafts: <span class="number">3</span></li>
                        <li>Things to do: <span class="number">3</span></li>
                        <li>Comments waiting for aproval: <span class="number">20</span></li>
                        <li>Visits Today: <span class="number">230</span></li>
                    </ul>
                </div>
                <div class="quickview left">
                    <h3>Some data</h3>
                    <ul>
                        <li>Users online: <span class="number">15</span></li>
                        <li>Trafic increase: <span class="number">34%</span></li>
                        <li>Photos: <span class="number">3</span></li>
                        <li>Things to do: <span class="number">3</span></li>
                        <li>Photos waiting for aproval: <span class="number">31</span></li>
                        <li>Visits Today: <span class="number">230</span></li>
                    </ul>
                </div>
                <div id="chart" class="left">
                    <h3>Visits today</h3>
                    <div id="placeholder" ></div><!-- CHART -->
                    <a href="#" class="ico_chart more">Click to see more</a>
                </div>
            </div>
        </div><!-- end #dashboard -->



        <div id="shortcuts" class="clearfix">
            <h2 class="ico_mug">Panel shortcuts</h2>
            <ul>
                <li class="first_li"><a href=""><img src="<?php echo site_url('img/admin/theme.jpg') ?>" alt="themes" /><span>Themes</span></a></li>
                <li><a href=""><img src="<?php echo site_url('img/admin/statistic.jpg')?>" alt="statistics" /><span>Statistics</span></a></li>
                <li><a href=""><img src="<?php echo site_url('img/admin/ftp.jpg') ?>" alt="FTP" /><span>FTP</span></a></li>
                <li><a href=""><img src="<?php echo site_url('img/admin/users.jpg') ?>" alt="Users" /><span>Users</span></a></li>
                <li><a href=""><img src="<?php echo site_url('img/admin/comments.jpg') ?>" alt="Comments" /><span>Comments</span></a></li>
                <li><a href=""><img src="<?php echo site_url('img/admin/gallery.jpg') ?>" alt="Gallery" /><span>Gallery</span></a></li>
                <li><a href=""><img src="<?php echo site_url('img/admin/security.jpg') ?>" alt="Security" /><span>Security</span></a></li>

            </ul>
        </div><!-- end #shortcuts -->
    </div>
    <div id="sidebar" class="right">
        <h2 class="ico_mug">Sidebar</h2>
        <ul id="menu">
            <li>
                <a href="#" class="ico_posts">Posts</a>
                <ul>
                    <li><a href="#">Edit posts</a></li>
                    <li><a href="#">Add post</a></li>
                    <li><a href="#">Manage posts</a></li>
                </ul>
                <a href="#" class="ico_page">Pages</a>
                <ul>
                    <li><a href="#">Edit pages</a></li>
                    <li><a href="#">Add page</a></li>
                    <li><a href="#">Manage pages</a></li>
                </ul>
                <a href="#" class="ico_user">Users</a>
                <ul>
                    <li><a href="#">Edit users</a></li>
                    <li><a href="#">Add user</a></li>
                    <li><a href="#">Manage users</a></li>
                </ul>
                <a href="#" class="ico_settings">Settings</a>
                <ul>
                    <li><a href="#">Database</a></li>
                    <li><a href="#">Themes</a></li>
                    <li><a href="#">Options</a></li>
                </ul>
                <a href="#" class="ico_settings">Settings</a>
                <ul>
                    <li><a href="#">Database</a></li>
                    <li><a href="#">Themes</a></li>
                    <li><a href="#">Options</a></li>
                </ul>
            </li>


        </ul>

    </div><!-- end #sidebar -->
</div><!-- end #content_main -->
<div id="postedit" class="clearfix">
    <h2 class="ico_mug">Add new post</h2>
    <form action="post">
        <div><input id="post_title" type="text" size="30" tabindex="1" value="Type title" /></div>
        <div id="form_middle_cont" class="clearfix">
            <div class="left"><textarea id="markItUp" cols="80" rows="10"></textarea></div>
            <div class="left form_sidebar">
                <h3>Category: </h3>
                <ul>
                    <li><label><input type="checkbox" class="noborder" name="chbox"  />First category</label></li>
                    <li><label><input type="checkbox" class="noborder" name="chbox"  />Second category</label></li>
                    <li>
                        <ul>
                            <li><label><input type="checkbox" class="noborder" name="chbox"  />Subcategory</label></li>
                            <li><label><input type="checkbox" class="noborder" name="chbox"  />Subcategory</label></li>
                        </ul>
                    </li>
                    <li><label><input type="checkbox" class="noborder" name="chbox"  />Third category</label></li>
                </ul>
                <h3>Tags,</h3>

                <input type="text" value="Short" tabindex="2" />
                <p>
                    <span id="status">Status: Automated saving... </span>
                    <input type="submit" value="Preview" />
                    <input type="submit" value="Save" id="save" />
                </p>
            </div>
        </div>
    </form>
    <div id="success" class="info_div"><span class="ico_success">Yeah! Success!</span></div>
    <div id="fail" class="info_div"><span class="ico_cancel">Ups, there was an error</span></div>
    <div id="warning" class="info_div"><span class="ico_error">Ups, you miss something</span></div>

</div><!-- end #postedit -->

<div id="tabledata" class="section">
    <h2 class="ico_mug">Table data</h2>
    <table id="table">
        <thead>
            <tr>
                <th><input type="checkbox" class="noborder" /></th>
                <th>Date </th>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="table_check"><input type="checkbox" class="noborder" /></td>
                <td class="table_date">April 23, 2009</td>
                <td class="table_title"><a href="#">Something like post </a></td>
                <td><a href="#">Webdesign, Life, Custom</a></td>
                <td><a href="#"><img src="img/admin/accept.jpg" alt="accepted"/></a><a href="#"><img src="img/admin/cancel.jpg" alt="cancel"/></a><a href="#"><img src="img/admin/folder.jpg" alt="folder"/></a><a href="#"><img src="img/admin/edit.jpg" alt="edit"/></a></td>
                <td><span class="approved">Approved</span></td>
            </tr>
            <tr>
                <td class="table_check"><input type="checkbox" class="noborder" /></td>
                <td class="table_date">April 22, 2009</td>
                <td class="table_title"><a href="#">Another thing </a></td>
                <td><a href="#">Webdesign, Life, Custom</a></td>
                <td><a href="#"><img src="img/admin/accept.jpg" alt="accepted"/></a><a href="#"><img src="img/admin/cancel.jpg" alt="cancel"/></a><a href="#"><img src="img/admin/folder.jpg" alt="folder"/></a><a href="#"><img src="img/admin/edit.jpg" alt="edit"/></a></td>
                <td><span class="approved">Approved</span></td>
            </tr>
            <tr>
                <td class="table_check"><input type="checkbox" class="noborder" /></td>
                <td class="table_date">April 21, 2009</td>
                <td class="table_title"><a href="#">And this is also a post </a></td>
                <td><a href="#">Webdesign, Life, Custom</a></td>
                <td><a href="#"><img src="img/admin/accept.jpg" alt="accepted"/></a><a href="#"><img src="img/admin/cancel.jpg" alt="cancel"/></a><a href="#"><img src="img/admin/folder.jpg" alt="folder"/></a><a href="#"><img src="img/admin/edit.jpg" alt="edit"/></a></td>
                <td><span class="ico_pending">Pending</span></td>
            </tr>
            <tr>
                <td class="table_check"><input type="checkbox" class="noborder" /></td>
                <td class="table_date">April 21, 2009</td>
                <td class="table_title"><a href="#">And this is also a post </a></td>
                <td><a href="#">Webdesign, Life, Custom</a></td>
                <td><a href="#"><img src="img/admin/accept.jpg" alt="accepted"/></a><a href="#"><img src="img/admin/cancel.jpg" alt="cancel"/></a><a href="#"><img src="img/admin/folder.jpg" alt="folder"/></a><a href="#"><img src="img/admin/edit.jpg" alt="edit"/></a></td>
                <td><span class="ico_pending">Pending</span></td>
            </tr>
            <tr>
                <td class="table_check"><input type="checkbox" class="noborder"  /></td>
                <td class="table_date">April 21, 2009</td>
                <td class="table_title"><a href="#">And this is also a post </a></td>
                <td><a href="#">Webdesign, Life, Custom</a></td>
                <td><a href="#"><img src="img/admin/accept.jpg" alt="accepted"/></a><a href="#"><img src="img/admin/cancel.jpg" alt="cancel"/></a><a href="#"><img src="img/admin/folder.jpg" alt="folder"/></a><a href="#"><img src="img/admin/edit.jpg" alt="edit"/></a></td>
                <td><span class="ico_pending">Pending</span></td>
            </tr>
            <tr>
                <td class="table_check"><input type="checkbox" class="noborder"  /></td>
                <td class="table_date">April 21, 2009</td>
                <td class="table_title"><a href="#">And this is also a post </a></td>
                <td><a href="#">Webdesign, Life, Custom</a></td>
                <td><a href="#"><img src="img/admin/accept.jpg" alt="accepted"/></a><a href="#"><img src="img/admin/cancel.jpg" alt="cancel"/></a><a href="#"><img src="img/admin/folder.jpg" alt="folder"/></a><a href="#"><img src="img/admin/edit.jpg" alt="edit"/></a></td>
                <td><span class="ico_pending">Pending</span></td>
            </tr>
        </tbody>
    </table>
    <div id="table_options" class="clearfix">

        <ul>
            <li><a href="#">Select All</a></li>
            <li><a href="#">Select None</a></li>
            <li><label>	Action:<select id="kategoria" name="kategoria">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                    </select>
                </label></li>
        </ul>


    </div>
    <div class="pagination">
        <span class="pages">Page 1 of 3&#8201;</span>
        <span class="current">1</span>
        <a href="#" title="2">2</a>
        <a href="#" title="3">3</a>
        <a href="#" >&raquo;</a>
    </div>
</div> <!-- end #tabledata -->
<div class="section">

    <h1>Header h1</h1>
    <h2>Header h2</h2>
    <h3>Header h3</h3>
    <h4>Header h4</h4>
    <h5>Header h5</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#">Nam sapien dolor</a>, ultrices a rutrum quis, convallis nec nisi. <del>Morbi lorem est</del>, pellentesque ac suscipit ut, fringilla sit amet elit. Cras blandit turpis vitae augue laoreet gravida. Suspendisse potenti. Nullam vitae dui quam. Cras fringilla tincidunt metus venenatis suscipit. Vestibulum feugiat felis tincidunt felis fermentum fringilla. In a ante metus. Nullam consequat hendrerit orci quis volutpat. Etiam a libero nunc. Sed convallis suscipit lectus quis hendrerit. Aliquam et elementum risus. Proin at feugiat lacus. Suspendisse non odio ante, et porta turpis. Integer bibendum augue at nisi porta vel luctus nisl fringilla. Donec in libero erat.</p>
<ul>
    <li>Element of unordered list</li>
    <li>Element of unordered list</li>
    <li>Element of unordered list</li>
</ul>
<ol>
    <li>Element of ordered list</li>
    <li>Element of ordered list</li>
    <li>Element of ordered list</li>
</ol>
<p class="info">Info paragraph. That's <em>em</em> and here is <strong>strong</strong>. And some <small>small text</small></p>
<hr />

<form action="post" method="post" accept-charset="utf-8">
    <fieldset>
        <legend><span>Internet Browsers</span></legend>
        <input type="radio" name="browser" class="noborder" />Internet Explorer<br />
        <input type="radio" name="browser" class="noborder" />Netscape Navigator<br />
        <input type="radio" name="browser" class="noborder" />Opera
        <br />  <br />
        <label><input type="text" value="Short" /></label>
        <label><input type="text" value="Medium" size="60" /></label>
        <label><input type="text" value="Long" size="90" /></label>

        <br /> <input type="submit" value="Continue" />
        <br />  <button>This is a button</button>

    </fieldset>

</form>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">First</a></li>
        <li><a href="#tabs-2">Second</a></li>

        <li><a href="#tabs-3">Third</a></li>
    </ul>
    <div id="tabs-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
    <div id="tabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
    <div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
</div>

</div><!-- end #section -->

<div id="panels" class="clearfix">
    <div class="panel photo left">
        <h2 class="ico_mug">Photo gallery</h2>
        <ul class="clearfix">
            <li><img src="img/photos/1.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
            <li><img src="img/photos/2.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
            <li><img src="img/photos/3.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
            <li><img src="img/photos/2.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
            <li><img src="img/photos/1.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
            <li><img src="img/photos/2.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
            <li><img src="img/photos/1.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
            <li><img src="img/photos/3.jpg" alt="photo"/><span><a href="#"><img src="img/admin/accept.jpg" alt="accept"/></a><a href="#"><img src="img/admin/cancel.jpg"  alt="deny"/></a></span></li>
        </ul>
        <button>Add photo</button>
    </div><!-- end #photo -->
    <div class="panel todo left">
        <h2 class="ico_mug">To do list</h2>
        <p>Things to do:</p>
        <ul>
            <li class="even"><input type="checkbox" class="noborder"  value="" name="check"/>
					Create more theme fot themeforest
                <span class="date">July 24, 2009</span>
            </li>
            <li class="odd"><input type="checkbox" class="noborder"  value="" name="check"/>
					Sell a looot fo themes
                <span class="date">July 24, 2009</span>
            </li>
            <li class="even"><input type="checkbox" class="noborder" value="" name="check"/>
					Learn ruby on rails
                <span class="date">July 24, 2009</span>
            </li>
            <li class="odd"><input type="checkbox" class="noborder" value="" name="check"/>
					Be a better man
                <span class="date">July 24, 2009</span>
            </li>
        </ul>
        <button>Add to do</button>
    </div><!-- end #todo -->
    <div class="panel calendar left">
        <h2 class="ico_mug">Callendar</h2>
        <div id="datepicker"></div>
        <button>Add event</button>
    </div><!-- end #calendar -->
</div><!-- end #panels -->
<div id="dialog" title="Welcome">
    <p>Thank you for stopping by :) Hope you like that theme.</p>
</div><!-- end #dialog [if you don't want this, delete whole div and 6th line i custom.js -->
