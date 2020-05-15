<div class="p-4 bg-light">
				<h4>About</h4>
				<p>Hello World..My name is Ansari and I'm a web developer, have been exploring the work of programming since 2 years...</p>
			</div>

			<div class="p-4">
				<h4 class="">Archives</h4>
				<p>
					<ol class="list-unstyled pt-2">
						<li><a href="#">Jan 2019</a></li>
					</ol>
				</p>

				<h4 class="mt-5">Categories</h4>
				<p>
					<ol class="list-unstyled pt-2">
						<?php 
						foreach ($categoryNames as $category): ?> 
							<li><a href='categories.php?cat_id=<?php echo $category['category_id']; ?>'><?php echo $category['category_name']; ?></a></li>
						
						<?php endforeach; ?>
						
					</ol>
				</p>
			</div>