<?php
$conn = mysqli_connect("localhost", "root", "", "cherished_shots");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT image_link, image_name, image_date, catagory FROM gallery";
$result = mysqli_query($conn, $sql);

if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

$images = array();
while ($row = mysqli_fetch_assoc($result)) {
  $images[] = $row;
}

mysqli_close($conn);
?>

<br>
<H2 id="text">Showing all the images >:</H2>
<span>
  <label for="Sort">Sort by:</label>
  <select id="sort-options">
    <option value="alphabetical">Alphabetical</option>
    <option value="date">Date</option>
    </select>
  <input type="search" id="search-input" placeholder="Search...">
  <div class="gallery-container">
    <?php foreach ($images as $image) { ?>
    <div class="image-container">
      <img src="<?php echo $image['image_link']; ?>" class="gallery-image" alt="<?php echo $image['catagory']; ?>">
    </div>
    <?php } ?>
  </div>
</span>

<style>

  .gallery-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 8px;
  }

  .image-container {
    grid-column: span 1;
  }

  .gallery-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    object-position: center;
    border: 2px solid #333;
    border-radius: 10px;
    display: block;
    margin: auto;
  }

  #text{
    margin-left: 40px;
  }

  #sort-options {
    margin-bottom: 20px;
  }

  #search-input {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
  }

  .filter-sort-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
  }

  #sort-options {
    margin-right: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
  }

  #search-input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
  }

  .gallery-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .gallery-header h2 {
    margin: 0;
  }

</style>

<script>
  const sortOptions = document.getElementById('sort-options');
  const searchInput = document.getElementById('search-input');
  const galleryContainer = document.querySelector('.gallery-container');
  const images = <?php echo json_encode($images); ?>;

  sortOptions.addEventListener('change', (e) => {
    const sortBy = e.target.value;
    const searchTerm = searchInput.value.trim().toLowerCase();
    const filteredImages = images.filter((image) => {
      return image.image_name.toLowerCase().includes(searchTerm);
    });

    if (sortBy === 'alphabetical') {
      filteredImages.sort((a, b) => a.image_name.localeCompare(b.image_name));
    } else if (sortBy === 'date') {
      filteredImages.sort((a, b) => new Date(b.image_date) - new Date(a.image_date));
    }

    updateGallery(filteredImages);
  });

  searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.trim().toLowerCase();
    const sortBy = sortOptions.value;
    const filteredImages = images.filter((image) => {
      return image.image_name.toLowerCase().includes(searchTerm);
    });

    if (sortBy === 'alphabetical') {
      filteredImages.sort((a, b) => a.image_name.localeCompare(b.image_name));
    } else if (sortBy === 'date') {
      filteredImages.sort((a, b) => new Date(b.image_date) - new Date(a.image_date));
    }

    updateGallery(filteredImages);
  });

  function updateGallery(images) {
    galleryContainer.innerHTML = '';
    images.forEach((image) => {
      const imageContainer = document.createElement('div');
      imageContainer.className = 'image-container';
      const img = document.createElement('img');
      img.src = image.image_link;
      img.alt = image.image_name;
      img.className = 'gallery-image';
      imageContainer.appendChild(img);
      galleryContainer.appendChild(imageContainer);
    });
  }
</script>