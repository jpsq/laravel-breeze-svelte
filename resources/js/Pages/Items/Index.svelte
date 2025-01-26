<script>
  import { Inertia } from '@inertiajs/inertia';
  export let items = [];

  function deleteItem(id) {
    if (confirm('Are you sure?')) {
      Inertia.delete(`/items/${id}`);
    }
  }
</script>

<div>
  <h1>Items</h1>
  <a href="/items/create" class="btn btn-primary">Add Item</a>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      {#each items as item}
        <tr>
          <td>{item.name}</td>
          <td>{item.description}</td>
          <td>
            <a href={`/items/${item.id}/edit`} class="btn btn-warning">Edit</a>
            <button on:click={() => deleteItem(item.id)} class="btn btn-danger">Delete</button>
          </td>
        </tr>
      {/each}
    </tbody>
  </table>
</div>
