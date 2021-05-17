const id = document.querySelector(".article").getAttribute("data-id");
let commentId;
getComments(setComments, id);

function sendMessage() {
  event.preventDefault();
  //const logged_in_user_email = document.querySelector(".sent_comment .email");
  if (editId) {
    commentObject = {
      user_name: document.querySelector(".sent_comment .user_name").textContent,
      user_email: document.querySelector(".sent_comment .email").textContent,
      comment_text: document.querySelector(".sent_comment .message").value,
      comment_last_updated: Date.now(),
      comment_likes: [],
      article_id: parseInt(document.querySelector(".sent_comment .article_id").textContent),
      id: commentId,
    };
    console.log(commentObject);
    putComment(commentObject);
    setTimeout(() => {
      editId = null;
    }, 1000);
  } else {
    commentObject = {
      user_name: document.querySelector(".sent_comment .user_name").textContent,
      user_email: document.querySelector(".sent_comment .email").textContent,
      comment_text: document.querySelector(".sent_comment .message").value,
      comment_last_updated: Date.now(),
      comment_likes: [],
      article_id: parseInt(document.querySelector(".sent_comment .article_id").textContent),
    };
    postComment(commentObject);
  }
  document.querySelector("form").reset();
}
let editId;

function setUpEdit(id) {
  const user_email = document.querySelector(".sent_comment .email").textContent;
  const comment_email = event.target.parentElement.querySelector(".email").textContent;
  console.log(user_email, event.target.parentElement.querySelector(".email").textContent);
  if (user_email === comment_email) {
    const text = document.querySelector(".comment[data-id='" + id + "'] .text").textContent;
    document.querySelector("textarea").value = text;
    editId = document.querySelector(".comment").getAttribute("data-id");
  }
}

function setComments(comments) {
  document.querySelector(".comments").innerHTML = "";
  Array.prototype.forEach.call(comments, one => {
    //VARS
    const user_email = document.querySelector(".sent_comment .email").textContent;
    const seperateEmail = one.comment_likes.join("\n");
    let date = new Date(one.comment_last_updated);
    let day = date.getDate();
    let month = date.getMonth();
    let year = date.getFullYear();
    let theTime = date.getHours() + ":" + (date.getMinutes() < 10 ? "0" : "") + date.getMinutes();

    //CREATE ELEMENTS
    const comment = document.createElement("div");
    const name_wrapper = document.createElement("div");
    const name = document.createElement("p");
    const email = document.createElement("p");
    const text = document.createElement("p");
    const likes = document.createElement("p");
    const time = document.createElement("p");
    const deleteIt = document.createElement("button");
    const editIt = document.createElement("button");
    const likeIt = document.createElement("button");

    //SET ELEMENT CLASSES
    comment.className = "comment";
    name_wrapper.className = "name_wrapper";
    name.className = "name";
    email.className = "email";
    text.className = "text";
    likes.className = "likes";
    time.className = "time";
    deleteIt.className = "delete";
    editIt.className = "edit";
    likeIt.className = "like";

    //SET ELEMENT TEXTCONTENT
    time.textContent = `Posted at: ${day}/${month}-${year} at ${theTime}`;
    name.textContent = one.user_name;
    email.textContent = one.user_email;
    text.textContent = one.comment_text;
    likes.textContent = "Likes: " + one.comment_likes.length;
    deleteIt.textContent = "Delete";
    editIt.textContent = "Edit";
    likeIt.textContent = "❤";

    //ONCLICKS
    deleteIt.onclick = function () {
      const id = this.parentElement.dataset.id;
      deleteComment(id);
    };
    editIt.onclick = function () {
      const id = this.parentElement.dataset.id;
      commentId = this.parentElement.dataset.id;
      setUpEdit(id);
    };
    likeIt.onclick = function () {
      likeClicked(one, likeIt, user_email, email);
    };

    if (one.comment_likes.includes(user_email)) {
      likeIt.setAttribute("data-chosen", true);
      likeIt.title = "Unlike the comment";
    } else {
      likeIt.setAttribute("data-chosen", false);
      likeIt.title = "Like the comment";
    }

    comment.setAttribute("data-id", one.id);
    likes.title = seperateEmail;

    //APPEND ALL ELEMENTS
    name_wrapper.appendChild(name);
    comment.appendChild(name_wrapper);
    comment.appendChild(email);
    comment.appendChild(text);
    comment.appendChild(likes);
    comment.appendChild(time);
    comment.appendChild(deleteIt);
    comment.appendChild(editIt);
    name_wrapper.appendChild(likeIt);
    document.querySelector(".comments").appendChild(comment);
  });
  removeButtons();
}

function removeButtons() {
  const user_email = document.querySelector(".sent_comment .email").textContent;
  document.querySelectorAll(".email").forEach(email => {
    console.log(user_email, email.textContent);
    document.querySelectorAll(".comment").forEach(comment => {
      if (user_email !== comment.querySelector(".email").textContent) {
        comment.querySelector(".delete").classList.add("hide");
        comment.querySelector(".edit").classList.add("hide");
      } else {
        comment.querySelector(".like").classList.add("hide");
      }
    });
  });
}

function likeClicked(one, likeIt, user_email, email) {
  if (one.comment_likes.includes(user_email)) {
    const index = one.comment_likes.indexOf(email);
    let arrayOfEmails = one.comment_likes;
    let updatedEmails = arrayOfEmails.splice(index, 1);
    let newList = arrayOfEmails.concat();

    console.log("IN array " + newList);
    commentObject = {
      id: event.target.parentNode.parentNode.getAttribute("data-id"),
      user_name: event.target.parentNode.parentNode.querySelector(".name").textContent,
      user_email: event.target.parentNode.parentNode.querySelector(".email").textContent,
      comment_text: event.target.parentNode.parentNode.querySelector(".text").textContent,
      comment_last_updated: one.comment_last_updated,
      comment_likes: newList,
      article_id: parseInt(document.querySelector(".article_id").textContent),
    };
    putComment(commentObject, one.user_email);
  } else {
    commentObject = {
      id: event.target.parentNode.parentNode.getAttribute("data-id"),
      user_name: event.target.parentNode.parentNode.querySelector(".name").textContent,
      user_email: event.target.parentNode.parentNode.querySelector(".email").textContent,
      comment_text: event.target.parentNode.parentNode.querySelector(".text").textContent,
      comment_last_updated: one.comment_last_updated,
      comment_likes: one.comment_likes.concat(user_email),
      article_id: parseInt(document.querySelector(".article_id").textContent),
    };
    putComment(commentObject, one.user_email);
  }
}
