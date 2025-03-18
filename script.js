function validateForm() {
  var rating = document.forms["animeForm"]["rating"].value;
  if (rating < 1 || rating > 10) {
    alert("Rating harus antara 1 dan 10");
    return false;
  }
}
