<div class="span10">
	<article>
		<h1><?=$topic->title?></h1>
		<div>
			<div><?=kdate($topic->created)?></div>
			<?=auto_link($topic->description)?>
		</div>
	</article>
<div>     
    <form action="/index.php/topic/delete" method="post">
        <input type="hidden" name="topic_id" value="<?=$topic->id?>" />
        <a href="/index.php/topic/add" class="btn">추가</a>       
        <input type="submit" class="btn" value="삭제" />
    </form>
</div>
</div>