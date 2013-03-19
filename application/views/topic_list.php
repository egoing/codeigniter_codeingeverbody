					<div class="span2">
						<ul class="nav nav-tabs nav-stacked" id="sidebar">
						<?php
						foreach($topics as $entry){
						?>
							<li><a href="/index.php/topic/get/<?=$entry->id?>"><?=$entry->title?></a></li>
						<? 
						}
						?>
						</ul>	
					</div>