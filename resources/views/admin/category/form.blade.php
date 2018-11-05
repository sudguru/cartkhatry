<form class="" id="menu-add">
  	<h3>Add New Category</h3>
	<div class="form-group">
		<label for="addInputName">Name</label>
		<input type="text" class="form-control" id="addInputName" placeholder="Category" required>
	</div>
	<button class="btn btn-info" id="addButton">Add</button>
</form>

<form class="" id="menu-editor" style="display: none;">
  <h3>Editing <span id="currentEditName"></span></h3>
  <div class="form-group">
    <label for="addInputName">Name</label>
    <input type="text" class="form-control" id="editInputName" placeholder="Category" required>
  </div>
  <button class="btn btn-info" id="editButton">Edit</button>
</form>