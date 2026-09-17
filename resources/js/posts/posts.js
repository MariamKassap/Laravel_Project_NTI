document.addEventListener("DOMContentLoaded", () => {
    // =========================
    // Like / Unlike
    // =========================

    document.querySelectorAll(".like-form").forEach((form) => {
        form.addEventListener("submit", async function (event) {
            event.preventDefault();

            const button = form.querySelector(".like-button");
            const likeText = button.querySelector(".like-text");

            const likesCount = form
                .closest(".post-actions")
                .querySelector(".likes-count");

            const methodInput = form.querySelector('input[name="_method"]');

            const method = methodInput ? "DELETE" : "POST";

            try {
                const response = await fetch(form.action, {
                    method: method,

                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                        Accept: "application/json",
                    },
                });

                const data = await response.json();

                likesCount.innerHTML = `<strong>${data.likes_count}</strong> ${
                    data.likes_count === 1 ? "Like" : "Likes"
                }`;

                if (data.liked) {
                    button.classList.add("liked");

                    if (likeText) {
                        likeText.textContent = "Unlike";
                    } else {
                        button.textContent = "Unlike ❤️";
                    }

                    const icon = button.querySelector(".like-icon");
                    if (icon) icon.textContent = "❤️";

                    if (!form.querySelector('input[name="_method"]')) {
                        const methodInput = document.createElement("input");

                        methodInput.type = "hidden";
                        methodInput.name = "_method";
                        methodInput.value = "DELETE";

                        form.appendChild(methodInput);
                    }
                } else {
                    button.classList.remove("liked");

                    if (likeText) {
                        likeText.textContent = "Like";
                    } else {
                        button.textContent = "Like 🤍";
                    }

                    const icon = button.querySelector(".like-icon");
                    if (icon) icon.textContent = "🤍";

                    const methodInput = form.querySelector(
                        'input[name="_method"]',
                    );

                    if (methodInput) {
                        methodInput.remove();
                    }
                }
            } catch (error) {
                console.error("Like error:", error);
            }
        });
    });

    // =========================
    // Add Comment
    // =========================

    document.querySelectorAll(".comment-form").forEach((form) => {
        form.addEventListener("submit", async function (event) {
            event.preventDefault();

            const input = form.querySelector(".comment-input");

            const content = input.value.trim();

            if (!content) {
                return;
            }

            try {
                const response = await fetch(form.action, {
                    method: "POST",

                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),

                        Accept: "application/json",

                        "Content-Type": "application/json",
                    },

                    body: JSON.stringify({
                        content: content,
                    }),
                });

                const data = await response.json();

                const comment = document.createElement("div");

                comment.classList.add("comment");
                comment.style.opacity = "0";
                comment.style.transform = "translateY(6px)";
                comment.style.transition =
                    "opacity 0.3s ease, transform 0.3s ease";

                const avatar = document.createElement("div");
                avatar.classList.add("comment-avatar");
                avatar.textContent = (data.user_name || "?")
                    .charAt(0)
                    .toUpperCase();

                const body = document.createElement("div");
                body.classList.add("comment-body");

                const author = document.createElement("strong");
                author.classList.add("comment-author");
                author.textContent = data.user_name;

                const contentEl = document.createElement("p");
                contentEl.classList.add("comment-content");
                contentEl.textContent = data.content;

                body.appendChild(author);
                body.appendChild(contentEl);

                if (data.can_delete) {
                    const deleteForm = document.createElement("form");

                    deleteForm.action = data.delete_url;

                    deleteForm.method = "POST";

                    deleteForm.classList.add("comment-delete-form");

                    deleteForm.innerHTML = `
                        <input
                            type="hidden"
                            name="_token"
                            value="${document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")}"
                        >

                        <input
                            type="hidden"
                            name="_method"
                            value="DELETE"
                        >

                        <button
                            type="submit"
                            class="comment-delete-button"
                        >
                            Delete
                        </button>
                    `;

                    body.appendChild(deleteForm);
                }

                comment.appendChild(avatar);
                comment.appendChild(body);

                form.parentElement.insertBefore(comment, form);

                requestAnimationFrame(() => {
                    comment.style.opacity = "1";
                    comment.style.transform = "translateY(0)";
                });

                input.value = "";

                const commentsTitle = form
                    .closest(".post-comments")
                    ?.querySelector(".comments-count");

                if (commentsTitle) {
                    const current = parseInt(commentsTitle.textContent) || 0;
                    commentsTitle.textContent = current + 1;
                }
            } catch (error) {
                console.error("Comment error:", error);
            }
        });

        const input = form.querySelector(".comment-input");
        if (input) {
            input.addEventListener("keydown", (e) => {
                if (e.key === "Enter" && !e.shiftKey) {
                    e.preventDefault();
                    form.requestSubmit();
                }
            });
        }
    });

    // =========================
    // Delete Comment
    // =========================

    document.addEventListener("submit", async function (event) {
        const form = event.target.closest(".comment-delete-form");

        if (!form) {
            return;
        }

        event.preventDefault();

        const confirmed = confirm(
            "Are you sure you want to delete this comment?",
        );

        if (!confirmed) {
            return;
        }

        try {
            const response = await fetch(form.action, {
                method: "DELETE",

                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),

                    Accept: "application/json",
                },
            });

            const data = await response.json();

            if (data.success) {
                const comment = form.closest(".comment");

                if (comment) {
                    comment.style.transition =
                        "opacity 0.25s ease, transform 0.25s ease";
                    comment.style.opacity = "0";
                    comment.style.transform = "translateX(-8px)";

                    setTimeout(() => {
                        const postComments = comment.closest(".post-comments");
                        comment.remove();

                        const commentsTitle =
                            postComments?.querySelector(".comments-count");

                        if (commentsTitle) {
                            const current =
                                parseInt(commentsTitle.textContent) || 0;
                            commentsTitle.textContent = Math.max(
                                0,
                                current - 1,
                            );
                        }
                    }, 250);
                }
            }
        } catch (error) {
            console.error("Delete comment error:", error);
        }
    });

    // =========================
    // Delete Post Media
    // =========================

    document.querySelectorAll(".media-delete-form").forEach((form) => {
        form.addEventListener("submit", async function (event) {
            event.preventDefault();

            const confirmed = confirm(
                "Are you sure you want to delete this media?",
            );

            if (!confirmed) {
                return;
            }

            try {
                const response = await fetch(form.action, {
                    method: "DELETE",

                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),

                        Accept: "application/json",
                    },
                });

                const data = await response.json();

                if (data.success) {
                    const media = form.closest(".post-media-item");

                    if (media) {
                        media.style.transition =
                            "opacity 0.25s ease, transform 0.25s ease";
                        media.style.opacity = "0";
                        media.style.transform = "scale(0.95)";

                        setTimeout(() => {
                            media.remove();

                            const grid = document.querySelector(".media-grid");
                            if (grid && grid.children.length === 0) {
                                const empty = document.createElement("p");
                                empty.classList.add("media-empty");
                                empty.textContent =
                                    "No media attached to this post.";
                                grid.replaceWith(empty);
                            }
                        }, 250);
                    }
                }
            } catch (error) {
                console.error("Delete media error:", error);
            }
        });
    });

    // =========================
    // File Upload Label + Preview
    // =========================

    document.querySelectorAll(".file-input").forEach((input) => {
        input.addEventListener("change", () => {
            const label = input.nextElementSibling;
            if (label) {
                const span = label.querySelector("span");
                if (span) {
                    const count = input.files.length;

                    if (count > 0) {
                        span.textContent =
                            count === 1
                                ? `1 file selected: ${input.files[0].name}`
                                : `${count} files selected`;
                    } else {
                        span.textContent = "Choose files or drag & drop";
                    }
                }
            }

            const targetId = input.dataset.previewTarget;
            if (!targetId) return;

            const previewContainer = document.getElementById(targetId);
            if (!previewContainer) return;

            previewContainer
                .querySelectorAll(
                    "img[data-object-url], video[data-object-url]",
                )
                .forEach((el) => {
                    const url = el.dataset.objectUrl;
                    if (url) URL.revokeObjectURL(url);
                });

            previewContainer.innerHTML = "";

            const files = Array.from(input.files || []);

            if (files.length === 0) {
                previewContainer.dataset.empty = "true";
                return;
            }

            previewContainer.dataset.empty = "false";

            files.forEach((file) => {
                const item = document.createElement("div");
                item.classList.add("preview-item");

                const objectUrl = URL.createObjectURL(file);

                if (file.type.startsWith("image/")) {
                    const img = document.createElement("img");
                    img.src = objectUrl;
                    img.alt = file.name;
                    img.classList.add("preview-media");
                    img.dataset.objectUrl = objectUrl;
                    item.appendChild(img);
                } else if (file.type.startsWith("video/")) {
                    const video = document.createElement("video");
                    video.src = objectUrl;
                    video.controls = true;
                    video.muted = true;
                    video.preload = "metadata";
                    video.classList.add("preview-media");
                    video.dataset.objectUrl = objectUrl;
                    item.appendChild(video);
                } else {
                    const fallback = document.createElement("div");
                    fallback.classList.add("preview-fallback");
                    fallback.textContent = file.name;
                    item.appendChild(fallback);
                }

                const caption = document.createElement("div");
                caption.classList.add("preview-caption");
                caption.textContent = file.name;
                caption.title = file.name;
                item.appendChild(caption);

                previewContainer.appendChild(item);
            });
        });
    });

    // =========================
    // Clean up object URLs on page unload
    // =========================

    window.addEventListener("beforeunload", () => {
        document.querySelectorAll("[data-object-url]").forEach((el) => {
            const url = el.dataset.objectUrl;
            if (url) URL.revokeObjectURL(url);
        });
    });

    // =========================
    // Post Gallery Lightbox
    // =========================

    const lightbox = document.getElementById("post-lightbox");
    const stage = lightbox?.querySelector("[data-lightbox-stage]");
    const counter = lightbox?.querySelector("[data-lightbox-counter]");
    const btnPrev = lightbox?.querySelector("[data-lightbox-prev]");
    const btnNext = lightbox?.querySelector("[data-lightbox-next]");
    const btnClose = lightbox?.querySelector("[data-lightbox-close]");

    let currentItems = []; // array of { type, src }
    let currentIndex = 0;

    /**
     * Build the full media list for a given gallery (includes hidden media).
     */
    function getGalleryItems(galleryEl) {
        const hidden = galleryEl.querySelector(".gallery-hidden-data");
        if (!hidden) return [];

        return Array.from(hidden.querySelectorAll("span[data-src]")).map(
            (el) => ({
                type: el.dataset.type,
                src: el.dataset.src,
            }),
        );
    }

    /**
     * Render a single media into the stage.
     */
    function renderSlide() {
        if (!stage) return;

        stage.innerHTML = "";

        const item = currentItems[currentIndex];
        if (!item) return;

        if (item.type === "video") {
            const video = document.createElement("video");
            video.src = item.src;
            video.controls = true;
            video.autoplay = true;
            video.playsInline = true;
            video.preload = "metadata";
            stage.appendChild(video);
        } else {
            const img = document.createElement("img");
            img.src = item.src;
            img.alt = `Media ${currentIndex + 1}`;
            stage.appendChild(img);
        }

        if (counter) {
            counter.textContent = `${currentIndex + 1} / ${currentItems.length}`;
        }

        if (btnPrev) {
            btnPrev.disabled = currentItems.length <= 1;
        }
        if (btnNext) {
            btnNext.disabled = currentItems.length <= 1;
        }
    }

    function openLightbox(galleryEl, startIndex) {
        if (!lightbox) return;

        currentItems = getGalleryItems(galleryEl);
        if (!currentItems.length) return;

        currentIndex = Math.max(
            0,
            Math.min(startIndex || 0, currentItems.length - 1),
        );

        renderSlide();

        lightbox.hidden = false;
        document.body.classList.add("lightbox-open");
    }

    function closeLightbox() {
        if (!lightbox) return;

        lightbox.hidden = true;
        document.body.classList.remove("lightbox-open");

        if (stage) {
            // Pause any playing video
            const vid = stage.querySelector("video");
            if (vid) {
                try {
                    vid.pause();
                } catch (e) {}
            }
            stage.innerHTML = "";
        }
    }

    function goPrev() {
        if (currentItems.length <= 1) return;

        currentIndex =
            (currentIndex - 1 + currentItems.length) % currentItems.length;
        renderSlide();
    }

    function goNext() {
        if (currentItems.length <= 1) return;

        currentIndex = (currentIndex + 1) % currentItems.length;
        renderSlide();
    }

    // Attach click handlers on each gallery item
    document.querySelectorAll(".gallery-item").forEach((item) => {
        const handleOpen = () => {
            const gallery = item.closest(".post-gallery");
            if (!gallery) return;

            const idx = parseInt(item.dataset.galleryIndex || "0", 10);
            openLightbox(gallery, idx);
        };

        item.addEventListener("click", handleOpen);
        item.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                handleOpen();
            }
        });
    });

    // Lightbox controls
    btnClose?.addEventListener("click", closeLightbox);
    btnPrev?.addEventListener("click", goPrev);
    btnNext?.addEventListener("click", goNext);

    // Click outside stage closes
    lightbox?.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Keyboard controls
    document.addEventListener("keydown", (e) => {
        if (!lightbox || lightbox.hidden) return;

        if (e.key === "Escape") {
            e.preventDefault();
            closeLightbox();
        } else if (e.key === "ArrowLeft") {
            e.preventDefault();
            goPrev();
        } else if (e.key === "ArrowRight") {
            e.preventDefault();
            goNext();
        }
    });
});
