package main

import (
	"log"
	"net/http"
)

func main() {
	mux := http.NewServeMux()
	mux.Handle("/", &IndexHandler{})

	server := &http.Server{
		Addr:    ":65432",
		Handler: mux,
	}
	log.Println("Starting httpserver")
	log.Fatal(server.ListenAndServe())
}

// IndexHandler 首页
type IndexHandler struct {
}

func (*IndexHandler) ServeHTTP(w http.ResponseWriter, r *http.Request) {
	w.Write([]byte("hello world"))
}
