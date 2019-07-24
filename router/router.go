package Router

import (
	"fmt"
	"log"
	"net/http"
  "github.com/gin-gonic/gin"
  "github.com/masbagas23/octopus"
)

func router() *gin.Engine {
  router := gin.Default()

  user := router.Group("/user")
	{
    user.GET("/get", UserController.GetUser)
	}
  return router
}
