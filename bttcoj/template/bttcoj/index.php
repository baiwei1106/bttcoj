<?php $show_title="首页 - BTTCACM"; ?>
<?php //$show_title="包头师范学院ACM协会 - BTTCACM"; ?>
<?php include("template/$OJ_TEMPLATE/header.php");?>
<div class="padding">
  <div class="ui three column grid">
    <div class="eleven wide column">
      <h4 class="ui top attached block header"><i class="ui info icon"></i>公告</h4>
      <div class="ui bottom attached segment">
        <table class="ui very basic table">
          <thead>
            <tr>
              <th>标题</th>
              <th>时间</th>
            </tr>
          </thead>
          <tbody>
                <?php for($i=0;$i<$cut_news;$i++){ ?>
                    <tr>
                        <td><?php echo $view_news[$i][0]?></td>
                        <td><?php echo $view_news[$i][1]?></td>
                    </tr>
                <?php }?>
          </tbody>
        </table>
      </div>
      <h4 class="ui top attached block header"><i class="ui signal icon"></i>排名</h4>
      <div class="ui bottom attached segment">
        <table class="ui very basic center aligned table" style="table-layout: fixed; ">
          <thead>
            <tr>
	            <th style="width: 50px; ">#</th>
	            <th style="width: 170px; ">用户名</th>
	            <th>个性签名</th>
            </tr>
          </thead>
          <script>
          var lineHeight = 0;
          (function () {
            var div = document.createElement('div');
            div.style.position = 'fixed';
            div.style.left = -10000;
            div.style.visibility = 'hidden';
            div.innerText = '测试，Test.';
            document.body.appendChild(div);
            lineHeight = div.clientHeight;
          })();
          </script>
          <tbody>

            <?php
            for ( $i=0;$i<$rank_rows_cnt;$i++ ) {
                echo "<tr>";
                echo "<td>".$view_rank[$i][0]."</td>";
                echo "<td>".$view_rank[$i][1]."</td>";
                echo "<td>".$view_rank[$i][2]."</td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="right floated five wide column">
        <h4 class="ui top attached block header"><i class="ui quote left icon"></i>一言（ヒトコト）</h4>
        <div class="ui bottom attached center aligned segment">
          <div class="ui active centered inline loader" id="hitokoto-loader"></div>
          <script>
          $.get('https://sslapi.hitokoto.cn/?c=a', function (data) {
            if (typeof data === 'string') data = JSON.parse(data);
            $('#hitokoto-loader').removeClass('active');
            $('#hitokoto-content').css('display', '').text(data.hitokoto);
            if (data.from) {
              $('#hitokoto-from').css('display', '').text('——' + data.from);
            }
          });
          </script>
          <div style="font-size: 1em; line-height: 1.5em; display: none; " id="hitokoto-content"></div>
          <div style="text-align: right; margin-top: 15px; font-size: 0.9em; color: #666; display: none; " id="hitokoto-from"></div>
        </div>
      <!-- <h4 class="ui top attached block header"><i class="ui rss icon"></i>最近更新</h4>
      <div class="ui bottom attached segment">
	<table class="ui very basic center aligned table">
          <thead>
            <tr>
              <th width="70%">题目</th>
              <th width="30%">更新时间</th>
            </tr>
	  </thead>
	  <tbody>
	    <%
	    for (let problem of problems) {
	    %>
	    <tr>
	      <td><a href="<%= syzoj.utils.makeUrl(['problem', problem.id]) %>"><%= problem.title %></a></td>
	      <td><%= problem.time %></td>
	    </tr>
	    <% } %>
	  </tbody>
	</table>
      </div> -->
        <!-- <%
        if (fortune) {
            let color;
            if (fortune.fortune.indexOf('吉') != -1) color = '#0ccf00';
            else if (fortune.fortune.indexOf('凶') != -1) color = '#f25e65';
            else color = '#444';
        %>
        <h4 class="ui top attached block header"><i class="ui magic icon"></i>今日运势</h4>
        <div class="ui bottom attached segment">
            <div style="height: 15px; "></div>
            <div class="ui two column center aligned padded grid">
                <div class="one column row">
                    <div style="text-align: center; ">
                        <div style="color: <%= color %>; font-size: 49px;"><%- (user.sex == -1 ? '♀ ' : '♂ ') + fortune.fortune + (user.sex == 1 ? ' <span style="transform: scaleX(-1); display: inline-block; ">♂</span>' : ' ♀') %></div>
                    </div>
                </div>
                <div class="two column row">
                    <div class="column">
                        <div style="color: #0ccf00; ">
                            <% if (fortune.good.length) { %>
                            <strong>宜：</strong><%= fortune.good[0].title %>
                            <br>
                            <span style="color: #888; font-size: 0.7em; "><%= fortune.good[0].detail %></span>
                            <div style="margin-top: 10px; "></div>
                            <strong>宜：</strong><%= fortune.good[1].title %>
                            <br>
                            <span style="color: #888; font-size: 0.7em; "><%= fortune.good[1].detail %></span>
                            <% } else { %>
                            <strong>诸事不宜<br>
                            </strong>
                            <% } %>
                        </div>
                    </div>
                    <div class="column">
                        <div style="color: #f25e65; ">
                            <% if (fortune.bad.length) { %>
                            <strong>忌：</strong><%= fortune.bad[0].title %>
                            <br>
                            <span style="color: #888; font-size: 0.7em; "><%= fortune.bad[0].detail %></span>
                            <div style="margin-top: 10px; "></div>
                            <strong>忌：</strong><%= fortune.bad[1].title %>
                            <br>
                            <span style="color: #888; font-size: 0.7em; "><%= fortune.bad[1].detail %></span>
                            <% } else { %>
                            <strong>万事皆宜<br>
                            </strong>
                            <% } %>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <% } %> -->
      <h4 class="ui top attached block header"><i class="ui search icon"></i>题目跳转</h4>
      <div class="ui bottom attached segment">
        <form action="problem.php" method="get">
          <div class="ui search" style="width: 100%; ">
            <div class="ui left icon input" style="width: 100%; ">
              <input class="prompt" style="width: 100%; " type="text" placeholder="题目号 …" name="id">
              <i class="search icon"></i>
            </div>
            <div class="results" style="width: 100%; "></div>
          </div>
        </form>
      </div>
      <h4 class="ui top attached block header"><i class="ui calendar icon"></i>近期比赛</h4>
      <div class="ui bottom attached center aligned segment">
        <table class="ui very basic center aligned table">
          <thead>
            <tr>
              <th>比赛名称</th>
              <th>开始时间</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($view_contest as $row){
                echo "<tr>";
                echo "<td>";
                echo $row[0];
                echo $row[1];
                echo "</td>";
                echo "<td>";
                echo $row[2];
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
      <h4 class="ui top attached block header font-content"><i class="ui linkify icon"></i>友情链接</h4>
      <div class="ui bottom attached segment">
        <table width="100%">
        <tr>
        <td width="50%">
        <ul style="margin: 0; padding-left: 20px; ">
	    <li><a href="https://icpc.baylor.edu/" target="_blank" >ACM/ICPC</a></li>
	    <li><a href="http://www.c4top.cn/" target="_blank" >CCCC</a></li>
            <li><a href="http://ccpc.io/" target="_blank" >CCPC</a></li>
	    <li><a href="https://www.patest.cn/" target="_blank" >PAT</a></li>
	    <li><a href="https://pta.patest.cn/" target="_blank" >PTA</a></li>
	    <li><a href="http://gplt.patest.cn" target="_blank">GPLT天梯赛</a></li>
	    <li><a href="http://dasai.lanqiao.cn/" target="_blank">LanQiao蓝桥杯</a></li>
	    <li><a href="http://www.noi.cn/" target="_blank">NOIP</a></li>
            <li><a href="http://www.codeforces.com/" target="_blank"  >Codeforces</a></li>
            <li><a href="https://www.luogu.org/" target="_blank" >洛谷(NOIP)</a></li>
        </ul>
        </td>
        <td width="50%">
        <ul style="margin: 0; padding-left: 20px; ">
          <li><a href="http://oj.tsinsen.com/" target="_blank" >清橙Tsinsen(OI)</a></li>
          <li><a href="http://poj.org/" target="_blank" >POJ</a></li>
          <li><a href="http://acm.zju.edu.cn/" target="_blank" >ZOJ</a></li>
          <li><a href="http://acm.hdu.edu.cn/" target="_blank"  >HDOJ</a></li>
          <li><a href="https://uva.onlinejudge.org/" target="_blank" >UVa</a></li>
          <li><a href="http://train.usaco.org/usacogate" target="_blank" >USACO</a></li>
          <li><a href="http://acm.timus.ru/" target="_blank" >TimusOJ</a></li>
          <li><a href="https://leetcode-cn.com/explore/" target="_blank" >LeeCode</a></li>
          <li><a href="https://loj.ac/" target="_blank" >LibreOJ</a></li>
          <li><a href="https://imustacm.cn/" target="_blank" >IMUSTOJ</a></li>
        </ul>
        </td>
        </tr>
        </table>
      </div>
      <h4 class="ui top attached block header"><i class="ui rss icon"></i>联系我们</h4>
      <div class="ui bottom attached segment">
	<table class="ui very basic aligned">
          <!-- <thead>
            <tr>
              <th width="50%">题目</th>
              <th width="50%">更新时间</th>
            </tr>
	  </thead>-->
	  <tbody>
	    <tr>
	      <td><b>如果在使用中有任何问题请联系：</b></td>
	    </tr>
	    <tr>
	      <td>邮箱：bttcoj@163.com</td>
	    </tr>
	    <tr>
	      <td>QQ：2817508830</td>
	    </tr>
	    <tr>
	      <td><b>如果你想加入我们请联系：</b></td>
	    </tr>
	    <tr>
	      <td>邮箱：bttcacm@163.com</td>
	    </tr>
	    <tr>
	      <td>QQ：964882672</td>
	    </tr>
	    <tr>
		<td> 
	<p class="dasbox"><a href="javascript:void(0)" onClick="dashangToggle()" class="dashang" title="打赏，支持一下">打赏本站</a></p>	
		</td>
	    </tr>
	  </tbody>
	</table>
      </div>
    </div>
  </div>
</div>
<div class="share">
			<div class="hide_box"></div>
			<div class="shang_box">
				<div class="shang_close">
					<a href="javascript:void(0)" onclick="dashangToggle()" title="关闭">
						<img width="30px" src="img/gb.png">
					</a>
				</div>
				<div class="shang_tit">
					<p>感谢您的支持，我们会继续努力的!</p>
				</div>
				<div class="shang_payimg">
					<img id="mypayimg" src="img/alipayimg.jpg" alt="扫码支持" title="扫一扫">
				</div>
				<div class="pay_explain">扫码打赏，你说多少就多少</div>
				<div class="shang_payselect">
					<div class="pay_item checked" data-id="alipay">
						<span class="radiobox"></span>
						<span class="pay_logo">
							<img src="img/alipay.jpg" alt="支付宝">
						</span>
					</div>
					<div class="pay_item" data-id="wechat">
						<span class="radiobox"></span>
						<span class="pay_logo">
							<img src="img/wechat.jpg" alt="微信">
						</span>
					</div>
				</div>
				<script type="text/javascript">
					$(function() {
						$(".pay_item").click(function() {
							$(this).addClass('checked').siblings('.pay_item').removeClass('checked');
							var dataid = $(this).attr('data-id');
							var t = "img/" + dataid + "img.jpg";
							console.log(t);
							$("#mypayimg").attr("src", t);
						});
					});

					function dashangToggle() {
						$(".hide_box").fadeToggle();
						$(".shang_box").fadeToggle();
					}
				</script>
			</div>
		</div>
<?php include("template/$OJ_TEMPLATE/footer.php");?>
