var firebaseConfig = {
  apiKey: "AIzaSyCqQh2l9aBFnBo23gkWSzoMKfRoPti2liE",
  authDomain: "elearning-f658b.firebaseapp.com",
  projectId: "elearning-f658b",
  storageBucket: "elearning-f658b.appspot.com",
  messagingSenderId: "588386662606",
  appId: "1:588386662606:web:427f72516d27c37314f89f",
  measurementId: "G-5ZMLVFEQSZ",
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
var db = firebase.firestore();

function postInteraction() {
  db.collection("article_interactions")
    .add({
      article_id: 1,
      article_comments: 34,
      article_likes: 1815,
    })
    .then(docRef => {
      console.log("Document written with ID: ", docRef.id);
    })
    .catch(error => {
      console.error("Error adding document: ", error);
    });
}

function putInteraction() {
  payload = {
    id: "kr57XxAS2khwJZa4tcV1",
    article_id: 1,
    article_comments: 3,
    article_likes: 54,
  };
  db.collection("article_interactions").doc(payload.id).update({
    id: payload.id,
    article_id: payload.article_id,
    article_comments: payload.article_comments,
    article_likes: payload.article_likes,
  });
}

function getInteractions() {
  const unsubsribe = db.collection("article_interactions").onSnapshot(snapshot => {
    const interactions = snapshot.docs.map(doc => ({
      id: doc.id,
      ...doc.data(),
    }));

    console.log(interactions);
  });
  return () => unsubsribe();
}

function deleteInteractions() {
  let id = "5EkHIghDVKOLEBZFDsl6";
  db.collection("article_interactions").doc(id).delete();
}

function postComment(payload) {
  db.collection("comments")
    .add(payload)
    .then(docRef => {
      console.log("Document written with ID: ", docRef.id);
    })
    .catch(error => {
      console.error("Error adding document: ", error);
    });
}

function getComments(callback, id) {
  const unsubsribe = db
    .collection("comments")
    .where("article_id", "==", parseInt(id))
    .orderBy("comment_last_updated", "desc")
    .onSnapshot(snapshot => {
      const comments = snapshot.docs.map(doc => ({
        id: doc.id,
        ...doc.data(),
      }));

      console.log(comments);
      callback(comments);
    });
  return () => unsubsribe();
}

function putComment(payload, original_post_email) {
  console.log(payload);
  db.collection("comments").doc(payload.id).update({
    id: payload.id,
    user_email: payload.user_email,
    comment_text: payload.comment_text,
    comment_last_updated: payload.comment_last_updated,
    comment_likes: payload.comment_likes,
    article_id: payload.article_id,
  });
}

function deleteComment(id) {
  //TODO VALIDTATION
  db.collection("comments").doc(id).delete();
}
