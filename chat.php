<button class="open-button" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
  <form action="information.php" class="form-container">
    <h2>Chat</h2>

    <label for="msg"><b>Message</b></label>
    <textarea placeholder="Type anything and will proceed you to the FAQ page after search is click" name="msg" required></textarea>

    <button type="submit" class="btn">Proceed</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

