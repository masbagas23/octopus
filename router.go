package Router

import (
	"fmt"
	"log"
	"net/http"
  "github.com/gin-gonic/gin"
  "github.com/masbagas23/octopus-controller"
)

func router() *gin.Engine {
  router := gin.Default()

  user := router.Group("/user")
	{
    user.GET("/get", GetUser)
  	user.POST("/register", RegistUser)
  	user.PUT("/edit", EditUser)
  	user.DELETE("/delete", DelUser)
	}
  return router
}
