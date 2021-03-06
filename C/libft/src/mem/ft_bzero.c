/* ************************************************************************** */
/*                                                          LE - /            */
/*                                                              /             */
/*   ft_bzero.c                                       .::    .:/ .      .::   */
/*                                                 +:+:+   +:    +:  +:+:+    */
/*   By: mhotting <marvin@le-101.fr>                +:+   +:    +:    +:+     */
/*                                                 #+#   #+    #+    #+#      */
/*   Created: 2018/10/02 09:31:20 by mhotting     #+#   ##    ##    #+#       */
/*   Updated: 2018/10/04 08:05:44 by mhotting    ###    #+. /#+    ###.fr     */
/*                                                         /                  */
/*                                                        /                   */
/* ************************************************************************** */

#include "libft.h"

void	ft_bzero(void *s, size_t n)
{
	unsigned char *temp;

	if (n > 0)
	{
		temp = (unsigned char *)s;
		while (n > 0)
		{
			*temp = 0;
			temp++;
			n--;
		}
	}
}
