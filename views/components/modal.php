<?php
global $appState;
$events = array_map(fn($event) => ['type' => 'error', 'message' => $event], $appState->errors);
$events = array_merge($events, array_map(fn($event) => ['type' => 'success', 'message' => $event], $appState->messages));
?>
<script defer>
    window.addEventListener('load', function () {
        let events = <?= json_encode($events) ?>;

        let modal = document.getElementById("myModal");
        console.log(modal);
        let header = modal.getElementsByClassName("modal-header")[0];
        let body = modal.getElementsByClassName("modal-body")[0];
        let footer = modal.getElementsByClassName("modal-footer")[0];

        let span = header.getElementsByClassName("close")[0];
        let headerTitle = header.getElementsByClassName("modal-header-title")[0];
        let bodyMessage = body.getElementsByClassName("modal-body-message")[0];
        let footerTitle = footer.getElementsByClassName("modal-footer-title")[0];

        function updateModal() {
            let event = events.pop();
            if (event) {
                modal.style.display = "block";
                headerTitle.textContent = event.type.toUpperCase();
                bodyMessage.textContent = event.message;
            } else {
                modal.style.display = "none";
            }
        }

        function close() {
            modal.style.display = "none";
            updateModal();
        }

        span.onclick = function () {
            close();
        }

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                close();
            }
        });

        updateModal();
    });
</script>
<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2 class="modal-header-title">Modal Header</h2>
        </div>
        <div class="modal-body">
            <p class="modal-body-message">Some text in the Modal Body</p>
        </div>
        <div class="modal-footer">
            <h3 class="modal-footer-footer">&copy; 2025 Coffee Express.</h3>
        </div>
    </div>
</div>

