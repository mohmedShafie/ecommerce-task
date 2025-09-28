// Notification System
let notificationCount = 0;
let notifications = [];

// Initialize notifications
function initializeNotifications() {
    loadNotifications();
    setupPusher();
    updateNotificationCount();
    enableNotificationAudio();
}

// Load notifications from API
function loadNotifications() {
    const notificationsUrl = document
        .querySelector('meta[name="notifications-url"]')
        ?.getAttribute("content");
    if (!notificationsUrl) return;

    fetch(notificationsUrl)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status) {
                // Fix: Access the nested data array
                if (data.notifications && data.notifications.data) {
                    notifications = data.notifications.data || [];
                } else {
                    notifications = [];
                }

                renderNotifications();
                updateNotificationCount();
            }
        })
        .catch((error) => {
            console.error("Error loading notifications:", error);
        });
}

// Render notifications in dropdown
function renderNotifications() {
    const notificationsList = document.getElementById("notifications-list");
    if (!notificationsList) return;

    if (notifications.length === 0) {
        console.log("No notifications");
        notificationsList.innerHTML = `
            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-success">
                                <i class="ti ti-check"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">No notifications</h6>
                        <p class="mb-0">You're all caught up!</p>
                        <small class="text-muted">Just now</small>
                    </div>
                </div>
            </li>
        `;
        return;
    }

    notificationsList.innerHTML = notifications
        .map(
            (notification) => `
        <li class="list-group-item list-group-item-action dropdown-notifications-item ${
            notification.read_at || notification.is_read ? "read" : "unread"
        }" data-notification-id="${notification.id}">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <span class="avatar-initial rounded-circle bg-label-${getNotificationColor(
                            notification.notification_type
                        )}">
                            <i class="ti ${getNotificationIcon(
                                notification.notification_type
                            )}"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1 ${
                        notification.read_at || notification.is_read
                            ? ""
                            : "fw-bold"
                    }">${notification.title}</h6>
                    <p class="mb-0">${notification.message}</p>
                    <small class="text-muted">${formatTime(
                        notification.created_at
                    )}</small>
                    ${
                        notification.read_at || notification.is_read
                            ? '<small class="text-success d-block"><i class="ti ti-check"></i> Read</small>'
                            : '<small class="text-primary d-block"><i class="ti ti-circle-filled" style="font-size: 8px;"></i> New</small>'
                    }
                </div>
                <div class="flex-shrink-0">
                    ${
                        !(notification.read_at || notification.is_read)
                            ? `
                    <button class="btn btn-sm btn-link text-muted" onclick="markNotificationAsRead(${notification.id})" title="Mark as read">
                        <i class="ti ti-eye"></i>
                    </button>
                    `
                            : `
                    <span class="text-success">
                        <i class="ti ti-check-circle"></i>
                    </span>
                    `
                    }
                </div>
            </div>
        </li>
    `
        )
        .join("");
}

// Get notification color based on type
function getNotificationColor(type) {
    const colors = {
        success: "success",
        warning: "warning",
        danger: "danger",
        info: "info",
        system: "primary",
    };
    return colors[type] || "info";
}

// Get notification icon based on type
function getNotificationIcon(type) {
    const icons = {
        success: "ti-check",
        warning: "ti-alert-triangle",
        danger: "ti-exclamation-circle",
        info: "ti-info-circle",
        system: "ti-bell",
    };
    return icons[type] || "ti-info-circle";
}

// Format time for notifications
function formatTime(timestamp) {
    const date = new Date(timestamp);
    const now = new Date();
    const diff = now - date;

    if (diff < 60000) return "Just now";
    if (diff < 3600000) return `${Math.floor(diff / 60000)}m ago`;
    if (diff < 86400000) return `${Math.floor(diff / 3600000)}h ago`;
    return date.toLocaleDateString();
}

// Update notification count badge
function updateNotificationCount() {
    const unreadCount = notifications.filter(
        (n) => !n.read_at && !n.is_read
    ).length;
    const badge = document.getElementById("notification-count");
    if (badge) {
        badge.textContent = unreadCount;
        badge.style.display = unreadCount > 0 ? "inline" : "none";
    }

    // Also update any other notification count elements
    const countElements = document.querySelectorAll(".notification-count");
    countElements.forEach((element) => {
        element.textContent = unreadCount;
        element.style.display = unreadCount > 0 ? "inline" : "none";
    });
}

// Mark notification as read
function markNotificationAsRead(notificationId) {
    const markReadUrl = document
        .querySelector('meta[name="mark-read-url"]')
        ?.getAttribute("content");
    if (!markReadUrl) return;

    fetch(markReadUrl.replace(":id", notificationId), {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success || data.status) {
                const notification = notifications.find(
                    (n) => n.id === notificationId
                );
                if (notification) {
                    notification.read_at = new Date().toISOString();
                    notification.is_read = true;
                    updateNotificationCount();
                    renderNotifications();
                }

                // Handle redirection if provided
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                } else {
                    // Show success message if no redirection
                    showToastNotification(
                        "Notification",
                        data.message || "Notification marked as read",
                        "success"
                    );
                }
            }
        })
        .catch((error) => {
            console.error("Error marking notification as read:", error);
            showToastNotification(
                "Error",
                "Failed to mark notification as read",
                "danger"
            );
        });
}

// Mark all notifications as read
function markAllNotificationsAsRead() {
    const markAllReadUrl = document
        .querySelector('meta[name="mark-all-read-url"]')
        ?.getAttribute("content");
    if (!markAllReadUrl) return;

    fetch(markAllReadUrl, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success || data.status) {
                notifications.forEach((notification) => {
                    if (!notification.read_at && !notification.is_read) {
                        notification.read_at = new Date().toISOString();
                        notification.is_read = true;
                    }
                });
                updateNotificationCount();
                renderNotifications();

                // Show success message
                showToastNotification(
                    "Notifications",
                    data.message || "All notifications marked as read",
                    "success"
                );
            }
        })
        .catch((error) => {
            console.error("Error marking all notifications as read:", error);
            showToastNotification(
                "Error",
                "Failed to mark all notifications as read",
                "danger"
            );
        });
}

// Setup Pusher for real-time notifications
function setupPusher() {
    console.log("🔌 Setting up Pusher connection...");

    if (typeof Pusher !== "undefined") {
        try {
            const pusherKey = document
                .querySelector('meta[name="pusher-key"]')
                ?.getAttribute("content");
            const pusherCluster = document
                .querySelector('meta[name="pusher-cluster"]')
                ?.getAttribute("content");
            const agencyId = document
                .querySelector('meta[name="agency-id"]')
                ?.getAttribute("content");

            console.log("📡 Pusher config:", {
                pusherKey: !!pusherKey,
                pusherCluster,
                agencyId,
            });

            if (!pusherKey || !pusherCluster || !agencyId) {
                console.warn("⚠️ Missing Pusher configuration");
                return;
            }

            const pusher = new Pusher(pusherKey, {
                cluster: pusherCluster,
                encrypted: true,
                forceTLS: true,
                // Connection optimization
                disableStats: true,
                enabledTransports: ["ws", "wss"],
                // Connection timeout and retry settings
                activityTimeout: 30000, // 30 seconds
                pongTimeout: 10000, // 10 seconds
                unavailableTimeout: 16000, // 16 seconds
                // Connection retry settings
                maxReconnectGapInSeconds: 30,
                maxReconnectionAttempts: 6,
                // Additional connection settings
                authEndpoint: "/broadcasting/auth",
                auth: {
                    headers: {
                        "X-CSRF-TOKEN":
                            document
                                .querySelector('meta[name="csrf-token"]')
                                ?.getAttribute("content") || "",
                    },
                },
                // Controlled debugging
                enableLogging: false, // Disable default logging
                debug: function (message) {
                    // Only log important debug messages
                    if (
                        message.includes("connecting") ||
                        message.includes("connected") ||
                        message.includes("error") ||
                        message.includes("subscribing")
                    ) {
                        console.log("🔌 Pusher:", message);
                    }
                },
            });

            // Log connection state
            pusher.connection.bind("connected", function () {
                console.log("✅ Pusher connected successfully");
            });

            pusher.connection.bind("disconnected", function () {
                console.log("❌ Pusher disconnected");
            });

            pusher.connection.bind("failed", function () {
                console.log("❌ Pusher connection failed");
            });

            pusher.connection.bind("error", function (error) {
                // Handle different types of Pusher errors gracefully
                if (error && error.data) {
                    const errorCode = error.data.code;
                    const errorMessage = error.data.message;

                    switch (errorCode) {
                        case 1006:
                            // Normal close - not an error
                            console.log(
                                "🔌 Pusher connection closed normally (code 1006)"
                            );
                            break;
                        case 1001:
                            console.log(
                                "🔌 Pusher endpoint unavailable (1001) - will retry"
                            );
                            break;
                        case 1002:
                            console.log(
                                "🔌 Pusher protocol error (1002) - will retry"
                            );
                            break;
                        case 4000:
                            console.warn(
                                "⚠️ Pusher application does not exist"
                            );
                            break;
                        case 4001:
                            console.warn("⚠️ Pusher application disabled");
                            break;
                        case 4003:
                            console.warn(
                                "⚠️ Pusher application over connection quota"
                            );
                            break;
                        case 4004:
                            console.warn("⚠️ Pusher path not found");
                            break;
                        case 4005:
                            console.warn(
                                "⚠️ Pusher invalid version string format"
                            );
                            break;
                        case 4006:
                            console.warn(
                                "⚠️ Pusher unsupported version string format"
                            );
                            break;
                        case 4007:
                            console.warn(
                                "⚠️ Pusher no protocol version supplied"
                            );
                            break;
                        case 4008:
                            console.warn("⚠️ Pusher connection interrupted");
                            break;
                        default:
                            // Only log unexpected errors
                            if (errorCode < 1006 || errorCode > 1015) {
                                console.error(
                                    "❌ Pusher connection error:",
                                    error
                                );
                            } else {
                                console.log(
                                    "🔌 Pusher connection event:",
                                    errorCode,
                                    errorMessage
                                );
                            }
                    }
                } else if (error) {
                    // Handle errors without data property
                    const errorStr = error.toString().toLowerCase();
                    if (
                        !errorStr.includes("1006") &&
                        !errorStr.includes("normal")
                    ) {
                        console.error("❌ Pusher connection error:", error);
                    }
                } else {
                    console.log("🔌 Pusher connection event (no error data)");
                }
            });

            const channelName = `agency-channel-${agencyId}`;
            console.log("📺 Subscribing to channel:", channelName);

            const channel = pusher.subscribe(channelName);

            channel.bind("pusher:subscription_succeeded", function () {
                console.log(
                    "✅ Successfully subscribed to channel:",
                    channelName
                );
            });

            channel.bind("pusher:subscription_error", function (error) {
                console.error("❌ Subscription error:", error);
            });

            // Listen for new notifications
            channel.bind("agency-notification", function (data) {
                console.log("🔔 Received agency-notification:", data);
                console.log("🔔 Processing agency notification callback...");

                try {
                    // Validate data structure
                    if (!data) {
                        console.error(
                            "❌ Invalid notification data structure:",
                            data
                        );
                        return;
                    }

                    // Create notification object in the expected format
                    const notification = {
                        id: data.id,
                        title: data.title,
                        message: data.message,
                        notification_type: data.notification_type,
                        created_at: data.created_at,
                        read_at: data.is_read ? data.created_at : null,
                        is_read: data.is_read || false,
                        data: data.data || {},
                    };

                    // Add to notifications array
                    notifications.unshift(notification);
                    console.log(
                        "✅ Added to notifications array, new count:",
                        notifications.length
                    );

                    // Update UI
                    renderNotifications();
                    updateNotificationCount();

                    // Play sound and show toast
                    playNotificationSound();
                    showToastNotification(
                        notification.title || "New Notification",
                        notification.message || "You have a new notification",
                        notification.notification_type || "info"
                    );

                    console.log(
                        "✅ Agency notification callback completed successfully"
                    );
                } catch (error) {
                    console.error(
                        "❌ Error in agency notification callback:",
                        error
                    );
                }
            });

            // Listen for dashboard notifications
            channel.bind("dashboard.notification", function (data) {
                console.log("📊 Received dashboard.notification:", data);
                console.log("📊 Processing dashboard notification callback...");

                try {
                    // Validate data structure
                    if (!data) {
                        console.error(
                            "❌ Invalid dashboard notification data:",
                            data
                        );
                        return;
                    }

                    // Play sound and show toast
                    playNotificationSound();
                    showToastNotification(
                        data.title || "Dashboard Update",
                        data.message || "Dashboard notification received",
                        data.type || "info"
                    );

                    console.log(
                        "✅ Dashboard.notification callback completed successfully"
                    );
                } catch (error) {
                    console.error(
                        "❌ Error in dashboard.notification callback:",
                        error
                    );
                }
            });

            // Listen for test events
            channel.bind("test.notification", function (data) {
                console.log("🧪 Received test.notification:", data);
                console.log("🧪 Processing test notification callback...");

                try {
                    // Play sound and show toast
                    playNotificationSound();
                    showToastNotification(
                        "Test Event",
                        data.message ||
                            "Test notification received successfully!",
                        "success"
                    );

                    console.log(
                        "✅ Test.notification callback completed successfully"
                    );
                } catch (error) {
                    console.error(
                        "❌ Error in test.notification callback:",
                        error
                    );
                }
            });

            // Listen for generic notifications (fallback)
            channel.bind("notification", function (data) {
                console.log("📨 Received generic notification:", data);
                console.log("📨 Processing generic notification callback...");

                try {
                    playNotificationSound();
                    showToastNotification(
                        data.title || "Notification",
                        data.message || "You have received a notification",
                        data.type || "info"
                    );

                    console.log(
                        "✅ Generic notification callback completed successfully"
                    );
                } catch (error) {
                    console.error(
                        "❌ Error in generic notification callback:",
                        error
                    );
                }
            });

            // Debug: Listen to ALL events on the channel
            channel.bind_global(function (eventName, data) {
                if (!eventName.startsWith("pusher:")) {
                    console.log(
                        "🌐 Received event:",
                        eventName,
                        "with data:",
                        data
                    );
                }
            });

            // Store pusher instance for cleanup
            window.pusherInstance = pusher;
            window.pusherChannel = channel;

            console.log("✅ Pusher setup completed");

            // Enhanced connection management
            let reconnectAttempts = 0;
            const maxReconnectAttempts = 5;
            let reconnectTimer = null;

            // Connection state tracking
            pusher.connection.bind("state_change", function (states) {
                console.log(
                    `🔌 Pusher state changed: ${states.previous} → ${states.current}`
                );

                if (
                    states.current === "disconnected" ||
                    states.current === "failed"
                ) {
                    // Attempt graceful reconnection
                    if (reconnectAttempts < maxReconnectAttempts) {
                        reconnectAttempts++;
                        const delay = Math.min(
                            1000 * Math.pow(2, reconnectAttempts),
                            30000
                        );
                        console.log(
                            `🔄 Attempting reconnection ${reconnectAttempts}/${maxReconnectAttempts} in ${delay}ms`
                        );

                        reconnectTimer = setTimeout(() => {
                            try {
                                pusher.connect();
                            } catch (error) {
                                console.log(
                                    "Reconnection attempt failed:",
                                    error
                                );
                            }
                        }, delay);
                    } else {
                        console.warn(
                            "⚠️ Maximum reconnection attempts reached"
                        );
                    }
                } else if (states.current === "connected") {
                    // Reset reconnection counter on successful connection
                    reconnectAttempts = 0;
                    if (reconnectTimer) {
                        clearTimeout(reconnectTimer);
                        reconnectTimer = null;
                    }
                }
            });

            // Enhanced page lifecycle management
            document.addEventListener("visibilitychange", function () {
                if (document.visibilityState === "hidden") {
                    // Page is hidden - prepare for potential disconnection
                    console.log("📱 Page hidden - pausing Pusher activity");
                } else {
                    // Page is visible again - ensure connection
                    console.log("📱 Page visible - resuming Pusher activity");
                    if (
                        window.pusherInstance &&
                        window.pusherInstance.connection.state !== "connected"
                    ) {
                        console.log(
                            "🔄 Reconnecting Pusher after page visibility change"
                        );
                        try {
                            window.pusherInstance.connect();
                        } catch (error) {
                            console.log(
                                "Visibility reconnection error:",
                                error
                            );
                        }
                    }
                }
            });

            // Graceful disconnection on page unload
            window.addEventListener("beforeunload", function () {
                try {
                    if (window.pusherInstance) {
                        console.log("🔌 Gracefully disconnecting Pusher");
                        window.pusherInstance.disconnect();
                    }
                } catch (error) {
                    // Ignore errors during unload
                }
            });

            // Fallback for pagehide (iOS Safari)
            window.addEventListener("pagehide", function () {
                try {
                    if (window.pusherInstance) {
                        window.pusherInstance.disconnect();
                    }
                } catch (error) {
                    // Ignore errors during pagehide
                }
            });
        } catch (error) {
            console.error("❌ Failed to setup Pusher:", error);
        }
    } else {
        console.warn("⚠️ Pusher is not available");
    }
}

// Play notification sound
function playNotificationSound() {
    try {
        const audioUrl = document
            .querySelector('meta[name="notification-sound"]')
            ?.getAttribute("content");
        if (!audioUrl) {
            console.log("No notification sound URL found in meta tag");
            return;
        }

        console.log("Attempting to play notification sound:", audioUrl);

        // Create audio element
        const audio = new Audio(audioUrl);
        audio.volume = 0.7; // Set reasonable volume
        audio.preload = "auto";

        // Set up event listeners before playing
        audio.addEventListener("canplay", function () {
            console.log("Audio can start playing");
        });

        audio.addEventListener("canplaythrough", function () {
            console.log("Audio ready to play through");
        });

        audio.addEventListener("loadeddata", function () {
            console.log("Audio data loaded");
        });

        audio.addEventListener("ended", function () {
            console.log("Audio playback ended successfully");
            // Clean up
            try {
                audio.remove();
            } catch (e) {
                console.log("Audio cleanup:", e.message);
            }
        });

        audio.addEventListener("error", function (error) {
            console.error("Audio error event:", error);
            console.error("Audio URL:", audioUrl);
            console.error("Audio error code:", audio.error?.code);
            console.error("Audio error message:", audio.error?.message);

            // Try alternative approaches
            tryAlternativeNotificationSound(audioUrl);

            // Clean up
            try {
                audio.remove();
            } catch (e) {
                console.log("Audio cleanup on error:", e.message);
            }
        });

        audio.addEventListener("loadstart", function () {
            console.log("Audio loading started");
        });

        audio.addEventListener("abort", function () {
            console.log("Audio loading was aborted");
        });

        // Try to play the audio
        const playPromise = audio.play();

        if (playPromise !== undefined) {
            playPromise
                .then(() => {
                    console.log("✅ Notification sound played successfully");
                })
                .catch((error) => {
                    console.error(
                        "❌ Error playing notification sound:",
                        error
                    );
                    console.error("Error name:", error.name);
                    console.error("Error message:", error.message);

                    // Handle different types of errors
                    if (error.name === "NotAllowedError") {
                        console.log(
                            "🔇 Autoplay blocked - user interaction required for audio"
                        );
                        // Show visual indication that sound was blocked
                        showAudioBlockedNotification();
                    } else if (error.name === "NotSupportedError") {
                        console.log("🔇 Audio format not supported");
                        tryAlternativeNotificationSound(audioUrl);
                    } else if (error.name === "AbortError") {
                        console.log("🔇 Audio playback was aborted");
                        tryAlternativeNotificationSound(audioUrl);
                    } else {
                        console.log("🔇 Other audio error, trying alternative");
                        tryAlternativeNotificationSound(audioUrl);
                    }
                });
        } else {
            console.log("Play promise is undefined - older browser");
            // For older browsers, try to play directly
            try {
                audio.play();
                console.log("✅ Notification sound played (older browser)");
            } catch (e) {
                console.log("❌ Direct play failed:", e.message);
                tryAlternativeNotificationSound(audioUrl);
            }
        }

        // Fallback timeout
        setTimeout(() => {
            if (audio.readyState === 0) {
                console.log(
                    "Audio failed to load within timeout, trying alternative"
                );
                tryAlternativeNotificationSound(audioUrl);
            }
        }, 3000);
    } catch (error) {
        console.error("Exception in playNotificationSound:", error);
        // Try browser notification sound as fallback
        trySystemNotificationSound();
    }
}

// Try alternative notification sound methods
function tryAlternativeNotificationSound(originalUrl) {
    console.log("Trying alternative notification sound methods");

    // Method 1: Try with different audio settings
    try {
        const altAudio = new Audio(originalUrl);
        altAudio.volume = 0.5;
        altAudio.muted = false;
        altAudio.autoplay = false;

        // Force load
        altAudio.load();

        setTimeout(() => {
            altAudio
                .play()
                .then(() => {
                    console.log("✅ Alternative audio method succeeded");
                })
                .catch((e) => {
                    console.log(
                        "❌ Alternative audio method failed:",
                        e.message
                    );
                    trySystemNotificationSound();
                });
        }, 100);
    } catch (e) {
        console.log("Alternative audio method exception:", e.message);
        trySystemNotificationSound();
    }
}

// Try system notification sound
function trySystemNotificationSound() {
    console.log("Trying system notification sound");

    // Method 1: Web Audio API beep
    try {
        if (window.AudioContext || window.webkitAudioContext) {
            const audioContext = new (window.AudioContext ||
                window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);

            oscillator.frequency.value = 800; // 800Hz tone
            oscillator.type = "sine";

            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(
                0.01,
                audioContext.currentTime + 0.3
            );

            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.3);

            console.log("✅ System beep played");
            return;
        }
    } catch (e) {
        console.log("Web Audio API failed:", e.message);
    }

    // Method 2: Try default browser notification
    try {
        if ("Notification" in window && Notification.permission === "granted") {
            // Create silent notification just to trigger system sound
            const notification = new Notification("", {
                silent: false,
                tag: "system-sound",
            });
            setTimeout(() => notification.close(), 100);
            console.log("✅ Browser notification sound triggered");
            return;
        }
    } catch (e) {
        console.log("Browser notification sound failed:", e.message);
    }

    console.log("❌ All sound methods failed - notification will be silent");
}

// Show visual indication when audio is blocked
function showAudioBlockedNotification() {
    // Add a small visual indicator that audio was blocked
    const indicator = document.createElement("div");
    indicator.innerHTML = "🔇";
    indicator.style.cssText = `
        position: fixed;
        top: 20px;
        right: 80px;
        z-index: 10000;
        background: rgba(255, 193, 7, 0.9);
        color: white;
        padding: 5px 8px;
        border-radius: 15px;
        font-size: 14px;
        pointer-events: none;
        transition: opacity 0.3s ease;
    `;

    document.body.appendChild(indicator);

    setTimeout(() => {
        indicator.style.opacity = "0";
        setTimeout(() => {
            if (indicator.parentNode) {
                indicator.remove();
            }
        }, 300);
    }, 2000);
}

// Alternative function to enable audio after user interaction
function enableNotificationAudio() {
    let audioContextEnabled = false;

    document.addEventListener("click", function enableAudioOnFirstClick() {
        if (audioContextEnabled) return;

        const audioUrl = document
            .querySelector('meta[name="notification-sound"]')
            ?.getAttribute("content");

        if (audioUrl) {
            console.log(
                "🎵 Enabling audio context on first user interaction..."
            );
            const audio = new Audio(audioUrl);
            audio.volume = 0.1; // Very low volume for enabling context
            audio.preload = "auto";

            // Try to play and immediately pause to enable audio context
            const playPromise = audio.play();

            if (playPromise !== undefined) {
                playPromise
                    .then(() => {
                        console.log("✅ Audio context enabled successfully");
                        audio.pause();
                        audio.currentTime = 0;
                        audioContextEnabled = true;
                        // Don't remove immediately, let it finish
                        setTimeout(() => {
                            try {
                                audio.remove();
                            } catch (e) {
                                console.log("Audio cleanup:", e.message);
                            }
                        }, 100);
                    })
                    .catch((error) => {
                        console.log(
                            "❌ Could not enable audio context:",
                            error
                        );
                        // Try alternative method
                        try {
                            if (
                                window.AudioContext ||
                                window.webkitAudioContext
                            ) {
                                const audioContext = new (window.AudioContext ||
                                    window.webkitAudioContext)();
                                console.log(
                                    "✅ Audio context enabled via Web Audio API"
                                );
                                audioContextEnabled = true;
                            }
                        } catch (e) {
                            console.log("❌ Web Audio API also failed:", e);
                        }
                    });
            } else {
                console.log("✅ Audio context enabled (older browser)");
                audioContextEnabled = true;
            }
        }

        // Remove this listener after first use
        document.removeEventListener("click", enableAudioOnFirstClick);
    });
}

// Show toast notification
function showToastNotification(title, message, type = "info") {
    console.log("Attempting to show toast notification:", {
        title,
        message,
        type,
    });

    // Create toast element
    const toast = document.createElement("div");
    toast.className = `toast align-items-center text-white bg-${getNotificationColor(
        type
    )} border-0`;
    toast.setAttribute("role", "alert");
    toast.setAttribute("aria-live", "assertive");
    toast.setAttribute("aria-atomic", "true");
    toast.setAttribute("data-bs-autohide", "true");
    toast.setAttribute("data-bs-delay", "5000");
    toast.style.minWidth = "300px";
    toast.style.maxWidth = "400px";

    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <strong>${title}</strong><br>
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

    // Add to toast container
    let toastContainer = document.getElementById("toast-container");
    if (!toastContainer) {
        toastContainer = document.createElement("div");
        toastContainer.id = "toast-container";
        toastContainer.className =
            "toast-container position-fixed top-0 end-0 p-3";
        toastContainer.style.zIndex = "9999";
        toastContainer.style.pointerEvents = "none"; // Allow clicks to pass through container
        document.body.appendChild(toastContainer);
        console.log("Created toast container");
    }

    // Make individual toast clickable
    toast.style.pointerEvents = "auto";
    toastContainer.appendChild(toast);
    console.log("Toast added to container");

    // Show toast with multiple fallbacks
    try {
        if (typeof bootstrap !== "undefined" && bootstrap.Toast) {
            console.log("Using Bootstrap Toast");
            const bsToast = new bootstrap.Toast(toast, {
                animation: true,
                autohide: true,
                delay: 5000,
            });

            // Add event listeners before showing
            toast.addEventListener("hidden.bs.toast", () => {
                console.log("Toast hidden, removing");
                if (toast.parentNode) {
                    toast.remove();
                }
            });

            toast.addEventListener("shown.bs.toast", () => {
                console.log("Toast shown successfully");
            });

            // Show the toast
            bsToast.show();
            console.log("Bootstrap Toast shown");
        } else if (typeof $ !== "undefined" && $.fn.toast) {
            console.log("Using jQuery Bootstrap Toast");
            $(toast).toast({
                animation: true,
                autohide: true,
                delay: 5000,
            });

            $(toast).on("hidden.bs.toast", function () {
                console.log("jQuery toast hidden, removing");
                $(this).remove();
            });

            $(toast).on("shown.bs.toast", function () {
                console.log("jQuery toast shown successfully");
            });

            $(toast).toast("show");
            console.log("jQuery Toast shown");
        } else {
            console.log("Bootstrap not available, using fallback");
            // Enhanced fallback - show and animate manually
            toast.style.display = "block";
            toast.style.opacity = "0";
            toast.style.transform = "translateY(-20px)";
            toast.style.transition = "all 0.3s ease";

            // Force reflow then animate in
            toast.offsetHeight;
            toast.style.opacity = "1";
            toast.style.transform = "translateY(0)";
            console.log("Fallback toast shown");

            // Auto-hide after delay
            setTimeout(() => {
                console.log("Fallback toast timeout, hiding");
                toast.style.opacity = "0";
                toast.style.transform = "translateY(-20px)";
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, 5000);

            // Add click to close
            const closeBtn = toast.querySelector(".btn-close");
            if (closeBtn) {
                closeBtn.addEventListener("click", () => {
                    console.log("Fallback toast manually closed");
                    toast.style.opacity = "0";
                    toast.style.transform = "translateY(-20px)";
                    setTimeout(() => {
                        if (toast.parentNode) {
                            toast.remove();
                        }
                    }, 300);
                });
            }
        }

        console.log("✅ Toast notification setup completed");
    } catch (error) {
        console.error("❌ Error showing toast notification:", error);
        // Last resort - simple alert
        console.log("Using fallback alert");
        alert(`${title}\n${message}`);
    }
}

// Handle visibility changes for cleanup
document.addEventListener("visibilitychange", function () {
    if (document.visibilityState === "hidden") {
        // Page is being hidden - good place for cleanup if needed
    }
});

// Test notification function for debugging
function testNotification() {
    console.log("🧪 Testing notification system...");

    // Test toast
    showToastNotification(
        "Test Notification",
        "This is a test notification to check if the system is working.",
        "info"
    );

    // Test sound
    playNotificationSound();

    console.log("🧪 Test notification triggered");
}

// Comprehensive test function for debugging
function testNotificationSystem() {
    console.log("🧪 === COMPREHENSIVE NOTIFICATION SYSTEM TEST ===");

    // Test 1: Check if all required elements exist
    console.log("1. Checking required elements...");
    const audioUrl = document
        .querySelector('meta[name="notification-sound"]')
        ?.getAttribute("content");
    const pusherKey = document
        .querySelector('meta[name="pusher-key"]')
        ?.getAttribute("content");
    const agencyId = document
        .querySelector('meta[name="agency-id"]')
        ?.getAttribute("content");

    console.log("- Audio URL:", audioUrl ? "✅ Found" : "❌ Missing");
    console.log("- Pusher Key:", pusherKey ? "✅ Found" : "❌ Missing");
    console.log("- Agency ID:", agencyId ? "✅ Found" : "❌ Missing");

    // Test 2: Check libraries
    console.log("2. Checking libraries...");
    console.log(
        "- Bootstrap:",
        typeof bootstrap !== "undefined" ? "✅ Available" : "❌ Missing"
    );
    console.log(
        "- Bootstrap Toast:",
        typeof bootstrap !== "undefined" && bootstrap.Toast
            ? "✅ Available"
            : "❌ Missing"
    );
    console.log(
        "- jQuery:",
        typeof $ !== "undefined" ? "✅ Available" : "❌ Missing"
    );
    console.log(
        "- Pusher:",
        typeof Pusher !== "undefined" ? "✅ Available" : "❌ Missing"
    );

    // Test 3: Test audio
    console.log("3. Testing audio...");
    if (audioUrl) {
        console.log("Testing audio playback...");
        playNotificationSound();
    } else {
        console.log("❌ No audio URL available");
    }

    // Test 4: Test toast
    console.log("4. Testing toast notifications...");
    showToastNotification(
        "Test Toast",
        "This is a test toast notification",
        "success"
    );

    // Test 5: Test Pusher connection
    console.log("5. Testing Pusher connection...");
    if (window.pusherInstance) {
        const connection = window.pusherInstance.connection;
        console.log("- Connection state:", connection.state);
        console.log("- Socket ID:", connection.socket_id);

        if (window.pusherChannel) {
            console.log("- Channel name:", window.pusherChannel.name);
            console.log(
                "- Channel subscribed:",
                window.pusherChannel.subscribed
            );
        }
    } else {
        console.log("❌ Pusher instance not found");
    }

    // Test 6: Test notification data
    console.log("6. Current notification data...");
    console.log("- Notifications count:", notifications.length);
    console.log(
        "- Unread count:",
        notifications.filter((n) => !n.read_at && !n.is_read).length
    );

    console.log("🧪 === TEST COMPLETED ===");
    console.log("To test manually:");
    console.log("- testNotification() - Basic test");
    console.log("- testPusherEvent('agency-notification') - Test Pusher event");
    console.log("- checkPusherStatus() - Check Pusher status");
}

// Test Pusher event simulation
function testPusherEvent(eventName = "agency-notification") {
    console.log("🧪 Testing Pusher event:", eventName);

    if (!window.pusherChannel) {
        console.error("❌ Pusher channel not available");
        return false;
    }

    // Simulate different event types
    const testData = {
        "agency-notification": {
            id: Date.now(),
            title: "Test Agency Notification",
            message: "This is a test notification from Pusher simulation",
            notification_type: "success",
            created_at: new Date().toISOString(),
            is_read: false,
            data: { test: true },
        },
        "notification.new": {
            notification: {
                id: Date.now(),
                title: "Test New Notification",
                message: "This is a test notification from Pusher simulation",
                notification_type: "success",
                created_at: new Date().toISOString(),
            },
        },
        "dashboard.notification": {
            title: "Dashboard Test",
            message: "This is a test dashboard notification",
            type: "warning",
        },
        "test.notification": {
            message: "Pusher event simulation test successful!",
        },
    };

    const data = testData[eventName] || { message: "Generic test event" };

    // Trigger the event manually to test callbacks
    try {
        // Find and call the bound callback directly
        const callbacks = window.pusherChannel.callbacks || {};
        const eventCallbacks = callbacks[eventName] || [];

        if (eventCallbacks.length > 0) {
            console.log(
                `🎯 Found ${eventCallbacks.length} callback(s) for ${eventName}`
            );
            eventCallbacks.forEach((callback, index) => {
                console.log(`🎯 Calling callback ${index + 1}...`);
                callback(data);
            });
        } else {
            console.warn(`⚠️ No callbacks found for event: ${eventName}`);
            console.log("Available events:", Object.keys(callbacks));
        }

        return true;
    } catch (error) {
        console.error("❌ Error testing Pusher event:", error);
        return false;
    }
}

// Check Pusher connection status
function checkPusherStatus() {
    console.log("🔍 Pusher Status Check:");

    if (!window.pusherInstance) {
        console.log("❌ Pusher instance not found");
        return;
    }

    const connection = window.pusherInstance.connection;
    console.log("- Connection state:", connection.state);
    console.log("- Socket ID:", connection.socket_id);

    if (window.pusherChannel) {
        console.log("- Channel name:", window.pusherChannel.name);
        console.log("- Channel subscribed:", window.pusherChannel.subscribed);
        console.log(
            "- Channel callbacks:",
            Object.keys(window.pusherChannel.callbacks || {})
        );
    } else {
        console.log("❌ Channel not found");
    }

    // Test connection
    if (connection.state === "connected") {
        console.log("✅ Pusher is connected and ready");
        return true;
    } else {
        console.log("❌ Pusher connection issues");
        return false;
    }
}

// Force trigger a Pusher event (for backend testing)
function triggerTestEvent() {
    console.log("🚀 Attempting to trigger server-side test event...");

    const testUrl = window.location.origin + "/agency/test-notification";

    fetch(testUrl, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            title: "Test Notification from Frontend",
            message:
                "This is a test notification triggered from the frontend to verify the complete system.",
            type: "test",
        }),
    })
        .then((response) => {
            if (response.ok) {
                console.log("✅ Test event triggered successfully");
                return response.json();
            } else {
                console.log(
                    "⚠️ Test endpoint returned error:",
                    response.status
                );
                return response.json().then((data) => {
                    console.log("Error details:", data);
                });
            }
        })
        .then((data) => {
            if (data) {
                console.log("✅ Test notification response:", data);
            }
        })
        .catch((error) => {
            console.log("⚠️ Test endpoint not available:", error.message);
        });
}

// Expose test functions globally for debugging
window.testNotification = testNotification;
window.testNotificationSystem = testNotificationSystem;
window.testPusherEvent = testPusherEvent;
window.checkPusherStatus = checkPusherStatus;
window.triggerTestEvent = triggerTestEvent;

// Add debugging info to console
function debugNotificationSystem() {
    console.log("🔍 Notification System Debug Info:");
    console.log("- Bootstrap available:", typeof bootstrap !== "undefined");
    console.log(
        "- Bootstrap Toast available:",
        typeof bootstrap !== "undefined" && bootstrap.Toast
    );
    console.log("- jQuery available:", typeof $ !== "undefined");
    console.log("- Pusher available:", typeof Pusher !== "undefined");

    const audioUrl = document
        .querySelector('meta[name="notification-sound"]')
        ?.getAttribute("content");
    console.log("- Audio URL:", audioUrl);

    const pusherKey = document
        .querySelector('meta[name="pusher-key"]')
        ?.getAttribute("content");
    console.log("- Pusher key present:", !!pusherKey);

    const agencyId = document
        .querySelector('meta[name="agency-id"]')
        ?.getAttribute("content");
    console.log("- Agency ID:", agencyId);

    console.log("- Current notifications count:", notifications.length);
    console.log("- To test manually, run: testNotification()");
}

// Initialize notifications when DOM is loaded
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", function () {
        initializeNotifications();
        // Add debug info after a short delay
        setTimeout(debugNotificationSystem, 1000);
    });
} else {
    // DOM is already loaded
    initializeNotifications();
    setTimeout(debugNotificationSystem, 1000);
}
