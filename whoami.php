<?php
echo "User: " . get_current_user();
echo "<br>UID: " . posix_geteuid();
echo "<br>Process owner: " . getmyuid();
