<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Questions</title>
</head>
<body>
<?php include_once 'logged_in_header.php'; ?>

<a href="<?=url("category.php?id={$_GET['category_id']}");?>">Back to questions in this category</a>

<form method="post">
    Title <input type="text" name="title"/><br/>
    Question: <br/>
    <textarea rows="5" cols="30" name="body"></textarea><br/>
    Category:
    <select name="category">
        <?php foreach ($categories as $category): ?>
            <option <?=$category['id'] == $categoryId ? 'selected' : '';?> value="<?=$category['id'];?>"><?=$category['name'];?> (<?=$category['questions_count'];?>)</option>
        <?php endforeach; ?>
    </select>
    <br/><br/>
    Tags:<br/>
    <select multiple="multiple" name="existing_tags[]">
        <?php foreach ($tags as $tag): ?>
            <option value="<?=$tag['id'];?>"><?=$tag['name'];?> (<?=$tag['questions_count'];?>)</option>
        <?php endforeach; ?>
    </select>
    <br/>
    Add tags: <input type="text" name="new_tags" placeholder="Enter your tags separated by comma..."/>
    <br/>
    <input type="submit" value="Ask!"/>
</form>
</body>
</html>